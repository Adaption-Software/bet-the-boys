<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useBets } from '@/scripts/stores/bets.js';
import { storeToRefs } from 'pinia';
import { onMounted, onUnmounted } from 'vue';
import BetCard from '@/Components/Bet/BetCard.vue';

const store = useBets();
const { allBets } = storeToRefs(useBets());

const props = defineProps({
    placedBets: {
        type: Array,
        default: () => [],
    },
});

onMounted(() => {
    store.init('football', props.placedBets);
});

onUnmounted(() => {
    store.$reset();
});
</script>

<template>
    <Head title="Football" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                NFL
            </h2>
        </template>

        <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 gap-8 p-4 md:w-full">
                <BetCard
                    v-for="(bet, key) in allBets"
                    :key="key"
                    :event-id="key"
                    icon="/images/nfl-logo.png"
                    v-bind="bet"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
