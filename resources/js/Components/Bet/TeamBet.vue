<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
    team: {
        type: Object,
        default: () => null,
    },
});

const spreadClass = computed(() => {
    return parseFloat(props.team.spread?.price) >= 0
        ? 'text-green-500'
        : 'text-red-500';
});
</script>

<template>
    <button
        type="button"
        class="md:col-span-2 justify-self-center flex flex-col items-center cursor-pointer py-2 px-4 rounded-md bg-primary-400/30 hover:bg-primary-300/50"
    >
        <span class="font-semibold text-base text-center">{{ team.name }}</span>

        <span class="font-medium" :class="[spreadClass]">
            {{ team.spread?.price }}
        </span>
    </button>
</template>
