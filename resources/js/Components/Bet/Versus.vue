<script setup>
import { defineProps } from 'vue';
import TeamBet from '@/Components/Bet/TeamBet.vue';

defineProps({
    home: {
        type: Object,
        default: null,
    },
    away: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <div
        class="grid grid-cols-1 place-items-center md:grid-cols-5 items-center md:flex-row md:items-center md:justify-center gap-4 mb-4"
    >
        <TeamBet :team="home" />

        <span
            class="text-yellow-500 font-semibold border rounded-full p-2 size-10 justify-self-center"
            >VS</span
        >

        <TeamBet :team="away" />
    </div>
</template>
