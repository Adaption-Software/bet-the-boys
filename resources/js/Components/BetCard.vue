<script setup>
import { ref } from 'vue';
import { defineProps, defineEmits } from 'vue';

const emits = defineEmits(['chooseWinner']);

const selectedTeam = ref(null);

const props = defineProps({
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
    <div
        class="w-full bg-[#101010] text-white p-4 rounded-md border-secondary-100 space-y-3"
    >
        <div class="grid grid-cols-2 divide-x items-start">
            <div class="flex items-center gap-x-2">
                <img
                    v-if="icon"
                    :src="icon"
                    alt="League icon"
                    class="w-5 h-5 object-contain"
                />
                <span class="uppercase text-sm font-semibold">{{ title }}</span>
            </div>

            <div class="text-right text-sm text-gray-400">
                {{ eventDate }}, {{ eventTime }}
            </div>
        </div>

        <div class="flex items-center justify-center space-x-4 mb-4">
            <div
                @click="selectTeam('team1')"
                :class="[
                    'flex flex-col items-center cursor-pointer p-2 rounded-md',
                    selectedTeam === 'team1' ? 'border-2 border-blue-500' : '',
                ]"
            >
                <span class="font-semibold text-base">{{ team1 }}</span>

                <span
                    class="font-medium"
                    :class="
                        parseFloat(odds1) >= 0
                            ? 'text-green-500'
                            : 'text-red-500'
                    "
                    >{{ odds1 }}</span
                >
            </div>

            <span class="text-yellow-500 font-semibold border rounded-full p-2">VS</span>

            <!-- Team 2 -->
            <div
                @click="selectTeam('team2')"
                :class="[
                    'flex flex-col items-center cursor-pointer p-2 rounded-md',
                    selectedTeam === 'team2' ? 'border-2 border-blue-500' : '',
                ]"
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

        <!-- Bottom section: Confirm selection button -->
        <button
            @click="confirmChoice"
            :disabled="!selectedTeam"
            class="bg-transparent border border-gray-600 hover:bg-gray-700 text-white text-sm font-semibold py-2 px-4 rounded-md w-full disabled:opacity-50 disabled:cursor-not-allowed"
        >
            Confirm Choice
        </button>
    </div>
</template>
