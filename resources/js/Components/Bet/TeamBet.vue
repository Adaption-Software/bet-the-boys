<script setup>
import { defineProps } from 'vue';

const emits = defineEmits(['selectedWinningTeam']);

defineProps({
    team: {
        type: Object,
        default: () => null,
    },
});
</script>

<template>
    <div
        class="md:col-span-2 justify-self-center flex flex-col items-center cursor-pointer p-2 rounded-md"
    >
        <span class="font-semibold text-base text-center">{{ team.name }}</span>

        <button
            type="button"
            class="font-medium"
            :class="
                parseFloat(team.spread?.price) >= 0
                    ? 'text-green-500'
                    : 'text-red-500'
            "
            @click="emits('selectedWinningTeam', team.id)"
        >
            {{ team.spread?.price }}
        </button>
    </div>
</template>
