import { defineStore } from 'pinia';
import { ref } from 'vue';
export const isBetSlipModalVisible = ref(false);

export const useBets = defineStore('bets', {
    state: () => ({
        sport: null,
        allBets: null,
        placedBets: [],
        pendingBets: [],
    }),
    getters: {
        hasPlacedAllBets: (state) => state.placedBets.length >= 4,

        betSlipCount: (state) => state.pendingBets.length,

        isBetSlipFull: (state) => state.pendingBets.length >= 4,

        isBetInSlip: (state) => (eventId, teamId, betType) => {
            return state.pendingBets.some(
                (bet) =>
                    bet.event_id === eventId &&
                    Number(bet.team_id) === teamId &&
                    bet.bet_type === betType
            );
        },
    },
    actions: {
        init(sport, placedBets, allOdds) {
            this.sport = sport;
            this.placedBets = placedBets || [];
            this.allBets = allOdds;

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

        hasPendingBetType(betType) {
            return this.pendingBets.some((bet) => bet.bet_type === betType);
        },

        // Toggles a bet in and out of the bet slip
        toggleBetInSlip(betDetails) {
            const { event_id, team_id, bet_type } = betDetails;
            const existingIndex = this.pendingBets.findIndex(
                (bet) =>
                    bet.event_id === event_id &&
                    Number(bet.team_id) === team_id &&
                    bet.bet_type === bet_type
            );

            if (existingIndex > -1) {
                // Bet is already in the slip, so remove it
                this.pendingBets.splice(existingIndex, 1);
            } else {
                // Bet is not in the slip, add it if the slip isn't full
                if (this.pendingBets.length < 4) {
                    // We need to find full bet details (like team names) from allBets
                    const event = this.allBets?.find((e) => e.id === event_id);
                    const home_team = event?.home_team;
                    const away_team = event?.away_team;
                    const team = [home_team, away_team].find(
                        (t) => t.id === team_id
                    );

                    this.pendingBets.push({
                        ...betDetails,
                        team_name: team?.name,
                        event_details: event,
                    });
                }
            }

            // Automatically show the modal when the slip is full
            if (this.pendingBets.length >= 4) {
                isBetSlipModalVisible.value = true;
            }
        },

        // Action to clear the entire bet slip
        clearBetSlip() {
            this.pendingBets = [];
            isBetSlipModalVisible.value = false;
        },

        async confirmAndPlaceBets() {
            // Use Promise.all to send all bet requests in parallel
            const betPromises = this.pendingBets.map((bet) => {
                const payload = {
                    event_id: bet.event_id,
                    team_id: bet.team_id,
                    bet_type: bet.bet_type,
                    sport: this.sport,
                };
                return axios.post(route('api.place-bet'), payload);
            });

            try {
                const results = await Promise.all(betPromises);
                // On success, add the newly placed bets to our main `placedBets` array
                results.forEach(({ data }) => {
                    this.placedBets.push(data);
                });

                // Clear the temporary slip
                this.pendingBets = [];
                isBetSlipModalVisible.value = false;

            } catch (e) {
                console.error('One or more bets failed to place:', e);
            }
        },
    },
});
