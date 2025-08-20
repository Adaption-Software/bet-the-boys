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

        <div class="pt-12 h-full mx-4 py-4">
            <UsersDataTable :bets="bets" />
        </div>
    </AuthenticatedLayout>
</template>
