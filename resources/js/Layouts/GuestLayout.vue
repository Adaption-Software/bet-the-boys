<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0 bg-primary-500"
    >
        <div>
            <ApplicationLogo class="h-20 w-20 fill-current text-primary-200" />
        </div>

        <div
            class="mt-6 w-full overflow-hidden border px-6 py-4 sm:max-w-md sm:rounded-lg bg-primary-500 border-primary-200"
        >
            <slot />
        </div>
    </div>
</template>
