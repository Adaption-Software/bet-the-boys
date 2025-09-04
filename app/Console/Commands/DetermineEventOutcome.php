<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DetermineEventOutcome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:determine-event-outcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determine a sport events outcome for placed bets.';

    /**
     * Execute the console command.
     */
    public function handle() {}
}
