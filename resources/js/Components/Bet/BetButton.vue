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
    useLabel: {
        type: Boolean,
        default: false,
    },
});

const label = computed(() => {
    return props.betType.charAt(0).toUpperCase() + props.betType.slice(1);
});

const placed = computed(() => {
    const key = `${props.betType}Bet`;
    const bet = store[key];

    return (
        props.eventId === bet?.event_id && props.teamId === Number(bet?.team_id)
    );
});

const disabled = computed(() => {
    const key = `has${label.value}`;
    const hasBetType = store[key];

    return placed.value || store.disableBetting || hasBetType;
});
</script>

<template>
    <button
        :class="{ 'ring-1 ring-tertiary-300': placed }"
        class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-1 px-3 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed min-w-20"
        :disabled="disabled"
        @click="store.placeBet(eventId, teamId, betType)"
    >
        <slot />
    </button>
</template>
