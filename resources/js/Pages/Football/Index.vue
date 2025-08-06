<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {isBetSlipModalVisible, useBets} from '@/scripts/stores/bets.js';
import { storeToRefs } from 'pinia';
import { onMounted, onUnmounted } from 'vue';
import EventCard from '@/Components/Bet/EventCard.vue';
import Button from "primevue/button";
import Dialog from "primevue/dialog";

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

        <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 gap-8 p-4 md:w-full">
                <EventCard
                    v-for="event in allBets"
                    :key="event.id"
                    icon="/images/nfl-logo.png"
                    v-bind="event"
                />
            </div>
        </div>

        <Dialog
            v-model:visible="isBetSlipModalVisible"
            modal
            header="Confirm Your Picks"
            :style="{ width: '50vw' }"
            :breakpoints="{ '960px': '75vw', '641px': '100vw' }"
            :closable="false"
        >
            <div class="p-fluid">
                <p class="mb-4">
                    Please review your 4 selections before confirming.
                </p>
                <ul class="list-none p-0 m-0 space-y-2">
                    <li v-for="bet in store.pendingBets" :key="`${bet.event_id}-${bet.bet_type}`" class="flex justify-between items-center p-2 bg-gray-800 rounded">
                        <span class="font-bold text-white">{{ bet.team_name }}</span>
                        <span class="text-tertiary-300 font-semibold">{{ bet.bet_type.toUpperCase() }}</span>
                    </li>
                </ul>
            </div>

            <template #footer>
                <Button label="Cancel" icon="pi pi-times" class="p-button-text" @click="cancelBets" />

                <Button label="Confirm Bets" icon="pi pi-check" autofocus @click="confirmBets" />
            </template>
        </Dialog>
    </AuthenticatedLayout>
</template>
