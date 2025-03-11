<script setup>
import { defineEmits } from 'vue';

defineEmits(['submit']);
</script>

<template>
    <form @submit.prevent="$emit('submit')" class="space-y-4">
        <slot />
    </form>
</template>
