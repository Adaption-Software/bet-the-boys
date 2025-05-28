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
        placeBet(event_id, selected_team_id) {
            console.log(event_id, selected_team_id);
            if (!event_id || !selected_team_id) {
                return;
            }

            axios
                .post(route('api.place-bet', { event_id, selected_team_id }))
                .then(({ data }) => console.log(data))
                .catch((e) => console.error(e));
        },
    },
});
