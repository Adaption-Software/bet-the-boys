<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-primary-500"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-primary-200" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white border px-6 py-4 border-primary-500 sm:max-w-md sm:rounded-lg dark:bg-primary-500 dark:border-primary-200"
        >
            <slot />
        </div>
    </div>
</template>
