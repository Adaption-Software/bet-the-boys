<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 transition duration-150 ease-in-out 0 focus:outline-none text-gray-300 hover:bg-primary-400 focus:bg-primary-400"
    >
        <slot />
    </Link>
</template>
