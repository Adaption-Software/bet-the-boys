<script setup>
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import { computed } from 'vue';

const props = defineProps({
    bets: {
        type: Object,
        default: () => null,
    },
});

const flattenedBets = computed(() => {
    if (!props.bets) {
        return [];
    }
    return Object.values(props.bets).flat();
});
console.log(flattenedBets.value)

</script>

<template>
    <div class="table-container p-4 md:p-6">
        <div v-if="flattenedBets.bets.length > 0">
            <DataTable
                :value="flattenedBets.bets"
                rowGroupMode="subheader"
                groupRowsBy="user"
                sortMode="single"
                sortField="user" :sortOrder="1"
                scrollable
                scrollHeight="700px"
                responsiveLayout="stack"
                breakpoint="768px"
                stripedRows
                class="p-datatable-sm md:p-datatable-md shadow-lg rounded-lg"
            >
                <Column field="user" header="Name" style="min-width: 12rem" :sortable="true"></Column>
                <Column field="sport" header="Sport" style="min-width: 10rem" :sortable="true"></Column>
                <Column field="bet_type" header="Bet Type" style="min-width: 10rem" :sortable="true"></Column>
                <Column field="outcome" header="Outcome" style="min-width: 10rem" :sortable="true"></Column>
                <Column field="bet_placed_at" header="Bet Placed At" style="min-width: 12rem" :sortable="true"></Column>

                <template #groupheader="slotProps">
                    <div class="flex items-center py-3 px-4 bg-slate-600 text-white font-semibold text-base md:text-lg">
                        <i class="pi pi-user mr-2"></i>
                        <span>{{ slotProps.data.user }}</span>
                    </div>
                </template>

                <template #groupfooter="slotProps">
                    <td colspan="3">
                        <div class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-slate-500 text-white">
                            <span>All Bets Placed: {{ slotProps.data.placed }}</span>
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-slate-500 text-white">
                            <span>Bets Lost: {{ slotProps.data.lost }}</span>
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-slate-500 text-white">
                            <span>Bets Won: {{ slotProps.data.win }}</span>
                        </div>
                    </td>
                    <td colspan="3">
                        <div class="flex justify-end items-center py-2 px-4 text-sm md:text-base font-semibold bg-slate-500 text-white">
                            <span>All Bets Placed: {{ slotProps.data.pushed }}</span>
                        </div>
                    </td>
                </template>
            </DataTable>
        </div>
        <div v-else class="p-4 text-center text-gray-500 bg-white dark:bg-slate-700 dark:text-gray-400 rounded-lg shadow">
            No bet data available.
        </div>
    </div>
</template>

<style scoped>
.table-container {
    max-width: 1200px;
    margin: 1rem auto;
}

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
    background-color: #374151;
    color: #ffffff;
    border-color: #4b5563;
}

:deep(.p-datatable .p-datatable-tbody > tr) {
    background-color: #2d3748;
    color: #e5e7eb;
}

:deep(.p-datatable.p-datatable-striped .p-datatable-tbody > tr:nth-child(even)) {
    background-color: #374151;
}
:deep(.p-datatable.p-datatable-striped .p-datatable-tbody > tr.p-row-odd) {
    background-color: #374151;
}
:deep(.p-datatable.p-datatable-striped .p-datatable-tbody > tr.p-row-even) {
    background-color: #2d3748;
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

@media (max-width: 768px) {
    .table-container {
        margin: 0.5rem auto;
        padding: 0.5rem;
    }

    :deep(.p-datatable-stacked .p-datatable-tbody > tr > td) {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 1rem;
        border-bottom: 1px solid #4b5563;
    }

    :deep(.p-datatable-stacked .p-datatable-tbody > tr > td:last-child) {
        border-bottom: none;
    }

    :deep(.p-datatable-stacked .p-column-title) {
        font-weight: 600;
        color: #cbd5e1;
        margin-right: 0.5rem;
        flex-shrink: 0;
    }

    :deep(.p-datatable-stacked .p-datatable-tbody > tr > td div) {
        width: 100%;
        text-align: right;
    }
    :deep(.p-datatable-stacked .p-datatable-group-header > tr > td div) {
        text-align: left;
    }
}
</style>
