<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-tertiary-500 focus:ring-tertiary-500 dark:border-gray-700 dark:bg-secondary-500 dark:text-secondary-100 dark:focus:border-tertiary-500 dark:focus:ring-tertiary-500"
        v-model="model"
        ref="input"
    />
</template>
