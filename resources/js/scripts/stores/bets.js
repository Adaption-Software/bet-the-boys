import { defineStore } from 'pinia';

export const useBets = defineStore('bets', {
    state: () => ({
        allBets: null,
        placedBets: null,
    }),
    actions: {
        getBets(sport) {
            axios
                .get(route('api.odds', { sport }))
                .then(({ data }) => {
                    this.allBets = data;
                })
                .catch((e) => {
                    console.error(e);
                });
        },
        placeBet(eventId) {
            axios
                .post(route('api.place-bet', { eventId }))
                .then(({ data }) => console.log(data))
                .catch((e) => console.error(e));
        },
    },
});
