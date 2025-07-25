<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EventCard from '@/Components/Bet/EventCard.vue';
import { onMounted } from 'vue';
import { useBets } from '@/scripts/stores/bets.js';
import { storeToRefs } from 'pinia';

const store = useBets();
const { allBets } = storeToRefs(useBets());

onMounted(() => {
    store.getBets('basketball');
});
</script>

<template>
    <Head title="Basketballs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                NBA
            </h2>
        </template>

        <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 gap-8 p-4 md:w-full">
                <EventCard
                    v-for="(bet, key) in allBets"
                    :key="key"
                    :event="key"
                    icon="/images/nba-logo.png"
                    v-bind="bet"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
