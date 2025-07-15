<script setup>
import { defineProps } from 'vue';
import BetButton from '@/Components/Bet/BetButton.vue';

const props = defineProps({
    team: {
        type: Object,
        default: () => null,
    },
    eventId: {
        type: String,
        required: true,
    },
    location: {
        type: String,
        required: true,
    },
});

console.log(props.team)
</script>

<template>
    <div class="flex items-center justify-between">
        <span class="truncate max-w-44 py-1 px-2 rounded-md bg-primary-400/30">
            {{ team.name }}
        </span>

        <div class="grid grid-cols-2 gap-3">
            <BetButton
                :bet-type="team.total.type"
                :team-id="team.id"
                :event-id="eventId"
            >
                <p>
                    {{ team.total.type.charAt(0).toUpperCase() }}
                    {{ team.total.point }}
                </p>

                <p>{{ team.total.price }}</p>
            </BetButton>

            <BetButton
                :bet-type="team.moneyline.type"
                :team-id="team.id"
                :event-id="eventId"
                use-label
            >
                <FontAwesome
                    :icon="team.moneyline.type === 'favorite' ? 'star' : 'bone'"
                    class="mr-2"
                />

                <span>{{ team.moneyline.price }}</span>
            </BetButton>
        </div>
    </div>
</template>
