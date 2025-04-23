<script setup>
import { useAttrs } from 'vue';

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

defineOptions({ inheritAttrs: false });

defineProps({
    modelValue: {
        type: [String, Number],
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    error: {
        type: String,
        default: null,
    },
    id: {
        type: String,
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);
const attrs = useAttrs();
</script>

<template>
    <div>
        <InputLabel v-if="label" :for="id" :value="label" />

        <TextInput
            :id="id"
            v-bind="attrs"
            class="mt-1 block w-full"
            :model-value="modelValue"
            @update:model-value="emit('update:modelValue', $event)"
        />

        <InputError v-if="error" class="mt-2" :message="error" />
    </div>
</template>
