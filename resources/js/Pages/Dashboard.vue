<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UsersDataTable from '@/Components/DataTables/UsersDataTable.vue';

defineProps({
    bets: {
        type: Object,
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

        <UsersDataTable
            :bets="bets"
        ></UsersDataTable>
    </AuthenticatedLayout>
</template>

<style>
.bets-datatable .p-datatable-table {
    border-spacing: 0 12px; /* adds vertical space between rows */
    border-collapse: separate !important;
}
</style>
