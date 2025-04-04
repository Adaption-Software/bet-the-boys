<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import StatCard from "@/Components/Stat/StatCard.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg bg-secondary-500 grid grid-cols-3 p-3 gap-3 text-gray-200">
                    <StatCard
                        title="Won"
                        stat="7"
                        trend="5"
                    ></StatCard>

                    <StatCard
                        title="Lost"
                        stat="7"
                    ></StatCard>

                    <StatCard
                        title="Placed"
                        stat="7"
                    ></StatCard>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
