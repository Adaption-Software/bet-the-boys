<script setup>
import { useBets } from '@/scripts/stores/bets.js';
import { computed } from 'vue';

const store = useBets();

const props = defineProps({
    betType: {
        type: String,
        required: true,
    },
    teamId: {
        type: Number,
        default: null,
    },
    eventId: {
        type: String,
        default: null,
    },
});

// Checks if THIS specific bet has been selected in the pending slip
const isSelected = computed(() => {
    return store.isBetInSlip(props.eventId, props.teamId, props.betType);
});

// Checks if this bet has already been confirmed and placed on the server
const isPlaced = computed(() => {
    return store.placedBets.some(
        (bet) =>
            bet.event_id === props.eventId &&
            Number(bet.team_id) === props.teamId &&
            bet.bet_type === props.betType
    );
});

const disabled = computed(() => {
    if (isPlaced.value) return true;

    if (store.isBetSlipFull && !isSelected.value) return true;

    if (store.hasPendingBetType(props.betType) && !isSelected.value)
        return true;

    return store.hasPlacedAllBets;
});

function handleBetSelection() {
    const betDetails = {
        event_id: props.eventId,
        team_id: props.teamId,
        bet_type: props.betType,
    };
    store.toggleBetInSlip(betDetails);
}
</script>

<template>
    <button
        :class="{
            'ring-2 ring-tertiary-300': isSelected,
            'ring-1 ring-green-400': isPlaced,
        }"
        class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-1 px-3 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed min-w-20 transition-all duration-150"
        :disabled="disabled"
        @click="handleBetSelection"
    >
        <slot />
    </button>
</template>
