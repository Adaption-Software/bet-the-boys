<script setup>
import { computed, defineProps, shallowRef } from 'vue';
import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
import { useBets } from '@/scripts/stores/bets.js';
import TeamBet from '@/Components/Bet/TeamBet.vue';

dayjs.extend(utc);

const props = defineProps({
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
        default: () => null,
    },
    away_team: {
        type: Object,
        default: () => null,
    },
    event: {
        type: String,
        default: () => null,
    },
});

const winningTeam = shallowRef(null);

const store = useBets();

const handleWinningTeamSelect = (team) => {
    winningTeam.value = team;
};

const eventDate = computed(() => {
    const date = dayjs(props.start_time);

    return props.start_time && date.isValid()
        ? date.utc().format('MMM DD, YYYY')
        : null;
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
                <img
                    v-if="icon"
                    :src="icon"
                    :alt="`${sport_title} logo`"
                    class="size-16 aspect-square object-contain"
                />
                <span class="uppercase text-sm font-semibold">
                    {{ sport_title }}
                </span>
            </div>

            <div class="text-sm text-right text-gray-400">
                {{ eventDate }}
            </div>
        </div>

        <div class="bg-secondary-500 p-4 h-full">
            <div
                class="grid grid-cols-1 place-items-center md:grid-cols-5 items-center md:flex-row md:items-center md:justify-center gap-4 mb-4"
            >
                <TeamBet
                    :team="home_team"
                    @selected-winning-team="handleWinningTeamSelect"
                />

                <span
                    class="text-yellow-500 font-semibold border rounded-full p-2 size-10 justify-self-center"
                >
                    VS
                </span>

                <TeamBet
                    :team="away_team"
                    @selected-winning-team="handleWinningTeamSelect"
                />
            </div>

            <button
                class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed"
                @click="store.placeBet(event, winningTeam)"
            >
                Confirm Choice
            </button>
        </div>
    </div>
</template>
