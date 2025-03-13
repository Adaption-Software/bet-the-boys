<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { FontAwesomeIcon as FontAwesome } from '@fortawesome/vue-fontawesome';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    icon: {
        type: String,
        default: null,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-tertiary-600 text-start text-base font-medium text-tertiary-700 dark:text-tertiary-300 bg-tertiary-50 dark:bg-tertiary-800/50 focus:outline-none focus:text-tertiary-800 dark:focus:text-tertiary-200 focus:bg-tertiary-100 dark:focus:bg-tertiary-900 focus:border-tertiary-700 dark:focus:border-tertiary-300 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <FontAwesome v-if="icon" :icon="props.icon" class="mr-3" />
        <slot />
    </Link>
</template>
