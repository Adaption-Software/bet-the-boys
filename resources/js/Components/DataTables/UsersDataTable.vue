<script setup>
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import { computed } from 'vue';

const props = defineProps({
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
const flattenedBets = computed(() => {
    if (!props.bets || Object.keys(props.bets).length === 0) {
        return [];
    }

    return Object.values(props.bets).flat();
});

</script>

<template>
    <div v-if="flattenedBets.length > 0">
        <DataTable
            :value="flattenedBets"
            rowGroupMode="subheader"
            groupRowsBy="user"
            scrollHeight="600px"
            tableStyle="min-width: 50rem"
            class="text-white"
        >
            <Column field="user" header="Name" style="min-width: 100px"> </Column>
            <Column field="sport" header="Sport" style="min-width: 100px"></Column>
            <Column field="bet_type" header="Bet Type" style="min-width: 100px"></Column>
            <Column field="outcome" header="Outcome" style="min-width: 100px"></Column>
            <Column field="bet_placed_at" header="Bet Placed At" style="min-width: 100px"></Column>

            <template #groupheader="slotProps">
                <div class="flex items-center py-2 px-4 bg-gray-100 text-gray-800 font-semibold">
                    <span>{{ slotProps.data.user }}</span>
                </div>
            </template>

            <template #groupfooter="placed">
                <div class="flex flex-end py-2 px-4 font-semibold">
                    <span>{{ props.placed }}</span>
                </div>
            </template>
        </DataTable>
    </div>
    <div v-else class="p-4 text-center text-gray-500">
        No bet data available.
    </div>
</template>

<style scoped></style>
