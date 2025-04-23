<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BetCard from '@/Components/Bet/BetCard.vue';
import { onMounted, ref } from 'vue';

//axios call for data from API controller
//build card component

const bets = ref();

onMounted(() => {
    axios
        .get(route('api.odds', { sport: 'basketball' }))
        .then(({ data }) => {
            console.log(data);
            bets.value = data;
        })
        .catch((e) => {
            console.error(e);
        });
});
</script>

<template>
    <Head title="Basketballs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                NBA
            </h2>
        </template>

        <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 gap-8 p-4 md:w-full">
                <BetCard
                    v-for="(bet, key) in bets"
                    :key="key"
                    icon="images/nba-logo.png"
                    v-bind="bet"
                    @choose-winner="onChooseWinner"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
