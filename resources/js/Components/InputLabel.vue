<script setup>
defineProps({
    value: {
        type: [String, null],
        default: () => null,
    },
});
</script>

<template>
    <label class="block text-sm font-medium text-gray-300">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
