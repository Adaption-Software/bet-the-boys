<?php

namespace App\Console\Commands;

use App\Enums\BetType;
use App\Enums\Outcome;
use App\Enums\Sport;
use App\Http\Integrations\TheOddsApi\Requests\ScoresRequest;
use App\Http\Integrations\TheOddsApi\TheOddsApiConnector;
use App\Models\Bet;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Throwable;

use function Laravel\Prompts\spin;

class DetermineEventOutcome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:determine-event-outcome {sport}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determine a sport events outcome for placed bets.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sport = Sport::tryFrom($this->argument('sport'));

        if (! $sport) {
            $this->error("{$this->argument('sport')} is not a valid sport");

            return 1;
        }

        $bets = Bet::query()
            ->where('sport', $sport)
            ->whereNull('outcome')
            ->get()
            ->groupBy('event_id');

        $eventIds = $bets->pluck('event_id')->unique();

        try {
            $events = spin(fn () => $this->fetchEventScores($sport, $eventIds), 'fetching scores');
        } catch (Throwable $e) {
            $this->error('Failed to fetch scores: '.$e->getMessage());

            return 1;
        }

        $events->each(function ($scores, $event) use ($bets) {
            $firstTeam = $scores->first();
            $secondTeam = $scores->last();

            $highestScoringTeam = $firstTeam === $secondTeam
                ? null
                : $scores->sortDesc()->keys()->first();

            $eventScoreTotal = $scores->sum();

            $eventBets = $bets->get($event);

            $eventBets?->each(function ($bet) use ($highestScoringTeam, $eventScoreTotal) {
                if ($highestScoringTeam) {
                    if ($bet->bet_type === BetType::Favorite || $bet->bet_type === BetType::Dawg) {
                        $won = $bet->team_id === $highestScoringTeam;

                        $this->setOutcome($bet, $won);
                    }
                } else {
                    $bet->outcome = Outcome::Draw;
                }

                if ($bet->bet_type === BetType::Under) {
                    $won = $bet->over_under < $eventScoreTotal;

                    $this->setOutcome($bet, $won);
                }

                if ($bet->bet_type === BetType::Over) {
                    $won = $bet->over_under > $eventScoreTotal;

                    $this->setOutcome($bet, $won);
                }

                $bet->save();
            });
        });
    }

    protected function fetchEventScores(Sport $sport, Collection $eventIds)
    {
        return app(TheOddsApiConnector::class)
            ->send(new ScoresRequest($sport, $eventIds))
            ->dto();
    }

    protected function setOutcome($bet, $won): void
    {
        $bet->outcome = $won ? Outcome::Win : Outcome::Lose;
    }
}
