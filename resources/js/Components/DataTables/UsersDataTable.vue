<script setup>
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';

defineProps({
    bets: {
        type: Object,
        default: () => null,
    },
});
</script>

<template>
    <div
        v-if="bets.length > 0"
        class="mx-4 py-4 h-4/5 shadow-lg rounded-lg border border-gray-300"
    >
        <DataTable
            :value="bets"
            row-group-mode="subheader"
            group-rows-by="user"
            sort-mode="single"
            sort-field="user"
            :sort-order="1"
            scrollable
            scroll-height="flex"
            responsive-layout="stack"
            breakpoint="768px"
            striped-rows
            class="p-datatable-sm md:p-datatable-md"
        >
            <template #groupheader="slotProps">
                <div
                    class="flex items-center py-3 px-4 bg-secondary-400 text-white font-semibold text-base md:text-lg"
                >
                    <i class="pi pi-user mr-2" />
                    <span>{{ slotProps.data.user }}</span>
                </div>
            </template>

            <Column
                field="user"
                header="Name"
                style="min-width: 12rem"
                :sortable="true"
            />

            <Column
                field="sport"
                header="Sport"
                style="min-width: 10rem"
                :sortable="true"
            />

            <Column
                field="bet_type"
                header="Bet Type"
                style="min-width: 10rem"
                :sortable="true"
            />

            <Column
                field="outcome"
                header="Outcome"
                style="min-width: 10rem"
                :sortable="true"
            />

            <Column
                field="bet_placed_at"
                header="Bet Placed At"
                style="min-width: 12rem"
                :sortable="true"
            />

            <template #groupfooter="slotProps">
                <td colspan="3">
                    <div
                        class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-secondary-400 text-white"
                    >
                        <span
                            >All Bets Placed:
                            {{ slotProps.data.placed_count }}</span
                        >
                    </div>
                </td>
                <td colspan="3">
                    <div
                        class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-secondary-400 text-white"
                    >
                        <span>Bets Lost: {{ slotProps.data.lost_count }}</span>
                    </div>
                </td>
                <td colspan="3">
                    <div
                        class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-secondary-400 text-white"
                    >
                        <span>Bets Won: {{ slotProps.data.won_count }}</span>
                    </div>
                </td>
                <td colspan="3">
                    <div
                        class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-secondary-400 text-white"
                    >
                        <span
                            >Bets Pushed:
                            {{ slotProps.data.pushed_count }}</span
                        >
                    </div>
                </td>
            </template>
        </DataTable>
    </div>

    <div
        v-else
        class="p-4 text-center text-gray-500 bg-white dark:bg-secondary-700 dark:text-gray-400 rounded-lg shadow"
    >
        No bet data available.
    </div>
</template>

<style scoped>
:deep(.p-datatable) {
    font-family: 'Inter', sans-serif;
}

:deep(.p-datatable.p-datatable-sm .p-datatable-thead > tr > th) {
    padding: 0.75rem 1rem;
}

:deep(.p-datatable.p-datatable-sm .p-datatable-tbody > tr > td) {
    padding: 0.75rem 1rem;
}

:deep(.p-datatable.p-datatable-md .p-datatable-thead > tr > th) {
    padding: 1rem 1.25rem;
}

:deep(.p-datatable.p-datatable-md .p-datatable-tbody > tr > td) {
    padding: 1rem 1.25rem;
}

:deep(.p-datatable .p-datatable-thead > tr > th) {
    background-color: #151515;
    color: #ffffff;
    border-color: #4b5563;
}

:deep(.p-datatable .p-datatable-tbody > tr) {
    background-color: #0a0a0a;
    color: #e5e7eb;
}

:deep(.p-datatable.p-datatable-striped .p-datatable-tbody > tr.p-row-odd) {
    background-color: #151515;
}

:deep(.p-datatable.p-datatable-striped .p-datatable-tbody > tr.p-row-even) {
    background-color: #0a0a0a;
}

:deep(.p-datatable .p-datatable-tbody > tr > td) {
    border-color: #4b5563;
}

:deep(.p-datatable .p-sortable-column .p-sortable-column-icon) {
    color: #9ca3af;
}

:deep(.p-datatable .p-sortable-column:hover) {
    background-color: #4b5563;
}

:deep(.p-datatable .p-sortable-column.p-highlight) {
    background-color: #4b5563;
    color: #ffffff;
}

:deep(.p-datatable .p-sortable-column.p-highlight .p-sortable-column-icon) {
    color: #ffffff;
}

:deep(.p-datatable .p-datatable-group-header > tr > td) {
    padding: 0;
}

:deep(.p-datatable .p-datatable-group-header > tr:hover > td) {
    background-color: transparent !important;
}

:deep(.p-datatable .p-datatable-group-footer > tr > td) {
    padding: 0;
}
</style>
