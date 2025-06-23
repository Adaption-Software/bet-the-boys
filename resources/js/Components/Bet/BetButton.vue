<script setup>
import { useBets } from '@/scripts/stores/bets.js';

const store = useBets();

defineProps({
    label: {
        type: String,
        required: true,
    },
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
</script>

<template>
    <button
        class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed"
        @click="store.placeBet(eventId, teamId, betType)"
    >
        {{ label }}
    </button>
</template>
