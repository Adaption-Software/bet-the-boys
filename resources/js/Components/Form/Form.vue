<script setup>
import { defineEmits } from 'vue';

defineEmits(['submit']);
</script>

<template>
    <form class="space-y-4" @submit.prevent="$emit('submit')">
        <slot />
    </form>
</template>
