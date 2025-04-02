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
            <div class="grid grid-cols-2 gap-8 w-full">
                <BetCard
                    icon="/assets/nhl-logo.svg"
                    title="NHL Premier League"
                    eventDate="3 Mar 2025"
                    eventTime="8:00 pm"
                    team1="TEAM 1"
                    odds1="+200"
                    team2="TEAM 2"
                    odds2="-200"
                    @chooseWinner="onChooseWinner"
                />

                <BetCard
                    icon="/assets/nba-logo.svg"
                    title="NBA Premier League"
                    eventDate="3 Mar 2025"
                    eventTime="8:00 pm"
                    team1="TEAM 3"
                    odds1="+150"
                    team2="TEAM 4"
                    odds2="-150"
                    @chooseWinner="onChooseWinner"
                />
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-secondary-500"
                >
                    <div class="flex flex-wrap gap-4">
                        <BetCard
                            icon="/assets/nhl-logo.svg"
                            title="NHL Premier League"
                            eventDate="3 Mar 2025"
                            eventTime="8:00 pm"
                            team1="TEAM 1"
                            odds1="+200"
                            team2="TEAM 2"
                            odds2="-200"
                            @chooseWinner="onChooseWinner"
                        />

                        <BetCard
                            icon="/assets/nba-logo.svg"
                            title="NBA Premier League"
                            eventDate="3 Mar 2025"
                            eventTime="8:00 pm"
                            team1="TEAM 3"
                            odds1="+150"
                            team2="TEAM 4"
                            odds2="-150"
                            @chooseWinner="onChooseWinner"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

