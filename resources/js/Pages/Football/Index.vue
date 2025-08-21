<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { isBetSlipModalVisible, useBets } from '@/scripts/stores/bets.js';
import { storeToRefs } from 'pinia';
import { onMounted, onUnmounted } from 'vue';
import EventCard from '@/Components/Bet/EventCard.vue';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';

const store = useBets();
const { allBets } = storeToRefs(useBets());

const props = defineProps({
    placedBets: {
        type: Array,
        default: () => [],
    },
});

function confirmBets() {
    store.confirmAndPlaceBets();
}

function cancelBets() {
    store.clearBetSlip();
}

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

        <div
            v-if="allBets?.length > 0"
            class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8"
        >
            <div class="grid sm:grid-cols-2 gap-8 p-4 md:w-full">
                <EventCard
                    v-for="event in allBets"
                    :key="event.id"
                    icon="/images/nfl-logo.png"
                    v-bind="event"
                />
            </div>
        </div>

        <div
            v-else
            class="flex flex-col space-y-3 items-center justify-center mt-12 mx-12 border border-secondary-300 py-4 rounded-md border-dashed"
        >
            <span class="text-gray-200 text-xl">No bets for this week</span>
        </div>

        <Dialog
            v-model:visible="isBetSlipModalVisible"
            modal
            :style="{
                width: '50vw',
                backgroundColor: 'white',
                border: '1px solid #e0e0e0',
                borderRadius: '8px',
                padding: '20px',
            }"
            :breakpoints="{ '960px': '75vw', '641px': '100vw' }"
            :closable="false"
        >
            <template #header>
                <div class="flex items-center justify-between">
                    <span class="font-bold text-xl">Confirm Your Picks</span>
                </div>
            </template>

            <div class="p-4">
                <p class="m-0 mb-4 text-surface-600 dark:text-surface-400">
                    Please review your 4 selections before confirming.
                </p>
                <ul class="list-none p-0 m-0 space-y-3">
                    <li
                        v-for="bet in store.pendingBets"
                        :key="`${bet.event_id}-${bet.bet_type}`"
                        class="flex justify-between items-center p-3 bg-surface-50 dark:bg-surface-800 border border-surface-200 dark:border-surface-700 rounded-lg"
                    >
                        <span
                            class="font-bold text-surface-700 dark:text-surface-200"
                            >{{ bet.team_name }}</span
                        >
                        <span
                            class="font-semibold text-primary-500 dark:text-primary-400"
                            >{{ bet.bet_type.toUpperCase() }}</span
                        >
                    </li>
                </ul>
            </div>

            <template #footer>
                <div class="flex justify-end gap-4">
                    <Button
                        class="font-bold"
                        label="Cancel"
                        severity="secondary"
                        @click="cancelBets"
                    />
                    <Button
                        class="font-bold"
                        label="Confirm Bets"
                        icon="pi pi-check"
                        autofocus
                        @click="confirmBets"
                    />
                </div>
            </template>
        </Dialog>
    </AuthenticatedLayout>
</template>
