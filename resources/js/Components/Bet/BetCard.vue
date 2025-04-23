<script setup>
import { defineProps } from 'vue';
import Versus from '@/Components/Bet/Versus.vue';

defineProps({
    icon: {
        type: String,
        default: '',
    },
    sport_title: {
        type: String,
        default: '',
    },
    start_time: {
        type: String,
        default: '',
    },
    home_team: {
        type: Object,
        default: null,
    },
    away_team: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <div
        class="border border-gray-700 rounded-xl overflow-hidden w-full text-white"
    >
        <div
            class="flex flex-row justify-between items-center px-4 py-2 bg-secondary-500 border-b border-gray-700"
        >
            <div class="flex items-center gap-x-2">
                <img v-if="icon" :src="icon" class="w-16 h-16 object-contain" />
                <span class="uppercase text-sm font-semibold">
                    {{ sport_title }}
                </span>
            </div>

            <div class="text-sm text-right text-gray-400">
                {{ start_time }}
            </div>
        </div>

        <div class="bg-secondary-500 p-4 h-full">
            <Versus :home="home_team" :away="away_team" />

            <button
                class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed"
            >
                Confirm Choice
            </button>
        </div>
    </div>
</template>
