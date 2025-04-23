<script setup>
defineProps({
    title: {
        type: String,
        required: true,
    },
    stat: {
        type: [String, Number],
        required: true,
    },
    trend: {
        type: [String, Number],
        required: false,
    },
});
</script>

<template>
    <div
        class="flex flex-col gap-y-2 md:grid-cols-3 p-6 bg-primary-500 rounded-md"
    >
        <div
            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium"
        >
            <span>{{ title }}</span>
        </div>

        <div class="text-3xl">
            {{ stat }}
        </div>

        <div
            v-if="trend"
            class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium"
        >
            <span>{{ trend }}</span>

            <svg
                class="w-4 h-4"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    fill-rule="evenodd"
                    d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                    clip-rule="evenodd"
                />
            </svg>
        </div>
    </div>
</template>
