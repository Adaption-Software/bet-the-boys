<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import StatCard from '@/Components/Stat/StatCard.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

const props = defineProps({
    bets: {
        type: Object,
    },
    wins: {
        type: Number,
    },
    losses: {
        type: Number,
    },
    placed: {
        type: Number,
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12 text-gray-200">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="bets" class="space-y-6">
                    <div class="space-y-4">
                        <p class="text-xl">Stats (MTD)</p>

                        <div
                            class="overflow-hidden shadow-sm sm:rounded-lg bg-secondary-500 grid grid-cols-3 p-3 gap-3"
                        >
                            <StatCard title="Won" :stat="wins" />

                            <StatCard title="Lost" :stat="losses" />

                            <StatCard title="Placed" :stat="placed" />
                        </div>
                    </div>

                    <div class="space-y-3">
                        <p class="text-xl">Bets Placed (MTD)</p>

                        <div class="bg-secondary-500 mt-6 p-3 rounded">
                            <DataTable
                                :value="bets"
                                class="bets-datatable bg-primary-500 text-gray-200 rounded p-3"
                            >
                                <Column
                                    field="over_under"
                                    header="Over/Under"
                                />
                                <Column field="outcome" header="Outcome" />
                                <Column field="created_at" header="Created" />
                            </DataTable>
                        </div>
                    </div>
                </div>

                <div v-else>
                    <div
                        class="rounded bg-secondary-500 flex justify-center py-12"
                    >
                        <span class="text-2xl">No bets placed</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.bets-datatable .p-datatable-table {
    border-spacing: 0 12px; /* adds vertical space between rows */
    border-collapse: separate !important;
}
</style>
