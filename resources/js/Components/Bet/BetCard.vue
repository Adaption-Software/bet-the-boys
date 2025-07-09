<script setup>
import { computed, defineProps } from 'vue';
import dayjs from 'dayjs';
import utc from 'dayjs/plugin/utc';
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
    eventId: {
        type: String,
        default: () => null,
    },
});

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

        <div
            class="flex flex-col gap-y-4 divide-y divide-gray-500 bg-secondary-500 p-2.5 h-full"
        >
            <TeamBet :team="away_team" :event-id="eventId" location="away" />

            <TeamBet
                class="pt-4"
                :team="home_team"
                :event-id="eventId"
                location="home"
            />
        </div>
    </div>
</template>
