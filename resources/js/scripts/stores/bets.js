import { defineStore } from 'pinia';

export const useBets = defineStore('bets', {
    state: () => ({
        sport: null,
        allBets: null,
        placedBets: [],
    }),
    getters: {
        disableBetting: (state) => state.placedBets.length >= 4,

        hasUnder: (state) =>
            state.placedBets.some((bet) => bet.bet_type === 'under'),

        underBet: (state) =>
            state.placedBets.filter((bet) => bet.bet_type === 'under')?.at(0),

        hasOver: (state) =>
            state.placedBets.some((bet) => bet.bet_type === 'over'),

        overBet: (state) =>
            state.placedBets.filter((bet) => bet.bet_type === 'over')?.at(0),

        hasFavorite: (state) =>
            state.placedBets.some((bet) => bet.bet_type === 'favorite'),

        favoriteBet: (state) =>
            state.placedBets
                .filter((bet) => bet.bet_type === 'favorite')
                ?.at(0),

        hasDawg: (state) =>
            state.placedBets.some((bet) => bet.bet_type === 'dawg'),

        dawgBet: (state) =>
            state.placedBets.filter((bet) => bet.bet_type === 'dawg')?.at(0),
    },
    actions: {
        init(sport, placedBets) {
            this.sport = sport;
            this.placedBets = placedBets;

            this.getBets();
        },
        getBets() {
            axios
                .get(route('api.odds', { sport: this.sport }))
                .then(({ data }) => {
                    this.allBets = data;
                })
                .catch((e) => {
                    console.error(e);
                });
        },
        placeBet(event_id, team_id, bet_type) {
            const payload = {
                event_id,
                team_id,
                bet_type,
                sport: this.sport,
            };

            axios
                .post(route('api.place-bet', payload))
                .then(({ data }) => {
                    this.placedBets.push(data);
                })
                .catch((e) => console.error(e));
        },
    },
});
