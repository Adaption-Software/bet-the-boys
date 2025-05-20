<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    bets: {
        type: Object,
        default: () => null,
    },
    wins: {
        type: Number,
        default: () => null,
    },
    losses: {
        type: Number,
        default: () => null,
    },
    placed: {
        type: Number,
        default: () => null,
    },
});
</script>

<template>
    <Head title="Bet The Boys" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                Dashboard
            </h2>
        </template>

    </AuthenticatedLayout>
</template>

<style>
.bets-datatable .p-datatable-table {
    border-spacing: 0 12px; /* adds vertical space between rows */
    border-collapse: separate !important;
}
</style>
