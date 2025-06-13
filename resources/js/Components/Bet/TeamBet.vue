<script setup>
import { computed, defineProps } from 'vue';
import BetButton from "@/Components/Bet/BetButton.vue";
import {useBets} from "@/scripts/stores/bets.js";

const store = useBets();

const props = defineProps({
    team: {
        type: Object,
        default: () => null,
    },
    eventId: {
        type: String,
        required: true
    }
});

const underPlaced = computed(() => {
   return props.eventId === store.underBet?.event_id && props.team.id === Number(store.underBet?.team_id);
});

const overPlaced = computed(() => {
    return props.eventId === store.overBet?.event_id && props.team.id === Number(store.overBet?.team_id);
});

const favoritePlaced = computed(() => {
    return props.eventId === store.favoriteBet?.event_id && props.team.id === Number(store.favoriteBet?.team_id);
});

const dawgPlaced = computed(() => {
    return props.eventId === store.dawgBet?.event_id && props.team.id === Number(store.dawgBet?.team_id);
});
</script>

<template>
    <div class="flex items-center justify-between">
        <span class="truncate max-w-44 py-1 px-2 rounded-md bg-primary-400/30">
            {{ team.name }}
        </span>

        <div class="grid grid-cols-4 gap-1">
            <BetButton
                :class="{'ring-1 ring-tertiary-300': underPlaced}"
                :disabled="store.hasUnder"
                label="Under"
                bet-type="under"
                :team-id="team.id"
                :event-id="eventId"
            />

            <BetButton
                :class="{'ring-1 ring-tertiary-300': overPlaced}"
                :disabled="store.hasOver"
                label="Over"
                bet-type="over"
                :team-id="team.id"
                :event-id="eventId"
            />

            <BetButton
                :class="{'ring-1 ring-tertiary-300': favoritePlaced}"
                :disabled="store.hasFavorite"
                label="Favorite"
                bet-type="favorite"
                :team-id="team.id"
                :event-id="eventId"
            />

            <BetButton
                :class="{'ring-1 ring-tertiary-300': dawgPlaced}"
                :disabled="store.hasDawg"
                label="Dawg"
                bet-type="dawg"
                :team-id="team.id"
                :event-id="eventId"
            />
        </div>
    </div>
</template>
