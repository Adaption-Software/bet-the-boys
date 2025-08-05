<script setup>
import { useBets, isBetSlipModalVisible } from '@/scripts/stores/bets.js';
import { computed } from 'vue';
import Button from 'primevue/button'; // Using PrimeVue button for consistency
import Dialog from 'primevue/dialog';

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
});

// Checks if THIS specific bet has been selected in the pending slip
const isSelected = computed(() => {
    return store.isBetInSlip(props.eventId, props.teamId, props.betType);
});

// Checks if this bet has already been confirmed and placed on the server
const isPlaced = computed(() => {
    return store.placedBets.some(
        (bet) =>
            bet.event_id === props.eventId &&
            Number(bet.team_id) === props.teamId &&
            bet.bet_type === props.betType
    );
});


const disabled = computed(() => {
    // Disable if it's already permanently placed
    if (isPlaced.value) return true;

    // Disable if the bet slip is full and this button is not one of the selected ones
    if (store.isBetSlipFull && !isSelected.value) return true;

    // Disable if a bet of the same type (e.g., 'under') is already selected, and it's not this one
    if (store.hasPendingBetType(props.betType) && !isSelected.value) return true;

    return store.hasPlacedAllBets;
});

function handleBetSelection() {
    const betDetails = {
        event_id: props.eventId,
        team_id: props.teamId,
        bet_type: props.betType,
    };
    store.toggleBetInSlip(betDetails);
}

function confirmBets() {
    store.confirmAndPlaceBets();
}

function cancelBets() {
    store.clearBetSlip();
}
</script>

<template>
    <button
        :class="{ 'ring-2 ring-tertiary-300': isSelected, 'ring-1 ring-green-400': isPlaced }"
        class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-1 px-3 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed min-w-20 transition-all duration-150"
        :disabled="disabled"
        @click="handleBetSelection"
    >
        <slot />
    </button>

    <Dialog
        v-model:visible="isBetSlipModalVisible"
        modal
        header="Confirm Your Picks"
        :style="{ width: '50vw' }"
        :breakpoints="{ '960px': '75vw', '641px': '100vw' }"
        :closable="false"
    >
        <div class="p-fluid">
            <p class="mb-4">Please review your 4 selections before confirming.</p>
            <ul class="list-none p-0 m-0 space-y-2">
                <li v-for="bet in store.pendingBets" :key="`${bet.event_id}-${bet.bet_type}`" class="flex justify-between items-center p-2 bg-gray-800 rounded">
                    <span class="font-bold text-white">{{ bet.team_name }}</span>
                    <span class="text-tertiary-300 font-semibold">{{ bet.bet_type.toUpperCase() }}</span>
                </li>
            </ul>
        </div>

        <template #footer>
            <Button label="Cancel" icon="pi pi-times" @click="cancelBets" class="p-button-text" />
            <Button label="Confirm Bets" icon="pi pi-check" @click="confirmBets" autofocus />
        </template>
    </Dialog>
</template>
