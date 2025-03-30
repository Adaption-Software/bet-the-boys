<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";


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

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-sm sm:rounded-lg bg-secondary-500"
                >
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

