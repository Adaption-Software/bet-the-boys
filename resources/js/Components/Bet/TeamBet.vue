<script setup>
import { computed, defineProps } from 'vue';
import BetButton from '@/Components/Bet/BetButton.vue';
import { useBets } from '@/scripts/stores/bets.js';

const store = useBets();

const props = defineProps({
    team: {
        type: Object,
        default: () => null,
    },
    eventId: {
        type: String,
        required: true,
    },
    location: {
        type: String,
        required: true,
    },
});

const checkPlacedBets = (key) => {
    return computed(() => {
        const bet = store[key];
        return (
            props.eventId === bet?.event_id &&
            props.team.id === Number(bet?.team_id)
        );
    });
};

const overPlaced = checkPlacedBets('overBet');
const underPlaced = checkPlacedBets('underBet');
const favoritePlaced = checkPlacedBets('favoriteBet');
const dawgPlaced = checkPlacedBets('dawgBet');
</script>

<template>
    <div class="flex items-center justify-between">
        <span class="truncate max-w-44 py-1 px-2 rounded-md bg-primary-400/30">
            {{ team.name }}
        </span>

        <div class="grid grid-cols-4 gap-1">
            <BetButton
                v-if="team.total.type === 'over'"
                class="flex flex-col gap-1"
                :disabled="store.disableBetting || store.hasOver"
                :placed="overPlaced"
                bet-type="over"
                :team-id="team.id"
                :event-id="eventId"
            >
                <span>{{ team.total.point }}</span>

                <span>{{ team.total.price }}</span>
            </BetButton>

            <BetButton
                v-else
                class="flex flex-col gap-1"
                :disabled="store.disableBetting || store.hasUnder"
                :placed="underPlaced"
                bet-type="under"
                :team-id="team.id"
                :event-id="eventId"
            >
                <span>{{ team.total.point }}</span>

                <span>{{ team.total.price }}</span>
            </BetButton>

            <BetButton
                :disabled="store.disableBetting || store.hasFavorite"
                :placed="favoritePlaced"
                bet-type="favorite"
                :team-id="team.id"
                :event-id="eventId"
            />

            <BetButton
                :disabled="store.disableBetting || store.hasDawg"
                :placed="dawgPlaced"
                bet-type="dawg"
                :team-id="team.id"
                :event-id="eventId"
            />
        </div>
    </div>
</template>
