<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BetCard from "@/Components/BetCard.vue";


//axios call for data from API controller
//build card component

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
            <div class="grid md:grid-cols-2 gap-8 p-4 md:w-full">
                <BetCard
                    icon="images/nba-logo.png"
                    title="NFL Premier League"
                    event-date="3 Mar 2025"
                    event-time="8:00 pm"
                    team1="TEAM 1"
                    odds1="+200"
                    team2="TEAM 2"
                    odds2="-200"
                    @choose-winner="onChooseWinner"
                />

                <BetCard
                    icon="images/nfl-logo.png"
                    title="NFL Premier League"
                    event-date="3 Mar 2025"
                    event-time="8:00 pm"
                    team1="TEAM 3"
                    odds1="+150"
                    team2="TEAM 4"
                    odds2="-150"
                    @choose-winner="onChooseWinner"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

