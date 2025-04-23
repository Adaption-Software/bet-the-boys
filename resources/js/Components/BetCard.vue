<script setup>
import { ref } from 'vue';
import { defineProps, defineEmits } from 'vue';

const emits = defineEmits(['chooseWinner']);

const selectedTeam = ref(null);

defineProps({
    icon: {
        type: String,
        default: '',
    },
    title: {
        type: String,
        default: '',
    },
    eventDate: {
        type: String,
        default: '',
    },
    eventTime: {
        type: String,
        default: '',
    },
    team1: {
        type: String,
        default: '',
    },
    team2: {
        type: String,
        default: '',
    },
    odds1: {
        type: String,
        default: '',
    },
    odds2: {
        type: String,
        default: '',
    },
});

function selectTeam(team) {
    selectedTeam.value = team;
}

function confirmChoice() {
    if (selectedTeam.value) {
        emits('chooseWinner', selectedTeam.value);
    }
}
</script>

<template>
    <!-- Outer card container with border and rounded corners -->
    <div
        class="border border-gray-700 rounded-xl overflow-hidden w-full text-white"
    >
        <!-- Header (league info) -->
        <div
            class="flex flex-col gap-y-4 md:flex-row justify-between items-center px-2 md:px-4 py-2 bg-[#101010] border-b border-gray-700"
        >
            <div class="flex items-center gap-x-2">
                <img v-if="icon" :src="icon" class="w-16 h-16 object-contain" />
                <span class="uppercase text-sm font-semibold">
                    {{ title }}
                </span>
            </div>

            <div class="text-sm text-gray-400">
                {{ eventDate }}, {{ eventTime }}
            </div>
        </div>

        <!-- Main content area -->
        <div class="bg-[#101010] p-4">
            <!-- Teams & odds -->
            <div
                class="flex flex-col items-center md:flex-row md:items-center md:justify-center gap-4 mb-4"
            >
                <!-- Team 1 -->
                <div
                    :class="[
                        'flex flex-col items-center cursor-pointer p-2 rounded-md',
                        selectedTeam === 'team1'
                            ? 'border-2 border-blue-500'
                            : '',
                    ]"
                    @click="selectTeam('team1')"
                >
                    <span class="font-semibold text-base">{{ team1 }}</span>
                    <span
                        class="font-medium"
                        :class="
                            parseFloat(odds1) >= 0
                                ? 'text-green-500'
                                : 'text-red-500'
                        "
                    >
                        {{ odds1 }}
                    </span>
                </div>

                <!-- VS -->
                <span
                    class="text-yellow-500 font-semibold border rounded-full p-2 size-10"
                >
                    VS
                </span>

                <!-- Team 2 -->
                <div
                    :class="[
                        'flex flex-col items-center cursor-pointer p-2 rounded-md',
                        selectedTeam === 'team2'
                            ? 'border-2 border-blue-500'
                            : '',
                    ]"
                    @click="selectTeam('team2')"
                >
                    <span class="font-semibold text-base">{{ team2 }}</span>
                    <span
                        class="font-medium"
                        :class="
                            parseFloat(odds2) >= 0
                                ? 'text-green-500'
                                : 'text-red-500'
                        "
                    >
                        {{ odds2 }}
                    </span>
                </div>
            </div>

            <!-- Confirm selection button -->
            <button
                :disabled="!selectedTeam"
                class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed"
                @click="confirmChoice"
            >
                Confirm Choice
            </button>
        </div>
    </div>
</template>
