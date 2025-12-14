<script setup>
    import { useId } from 'vue'
    const props = defineProps({
        label: String,
        id: String,
        type: {
            type: String,
            default: 'text'
        },
        placeholder: String,
        modelValue: [String, Number],
        className: String,
        autocomplete: {
            type: String,
            default: 'off'
        },
        error: String,
        errorCondition: {
            type: Boolean,
            default: true
        },
        disabled: {
            type: Boolean,
            default: false
        }
    })

    const inputId = props.id || useId()

    const emit = defineEmits(['update:modelValue'])
</script>

<template>
    <div class="mb-4">
        <label v-if="label" :for="inputId" class="block text-gray-700">
            {{ label }}
        </label>

        <input
        :id="inputId"
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        :autocomplete="autocomplete"
        @input="emit('update:modelValue', $event.target.value)"
        class="form-control"
        :class="className"
        :disabled="disabled" />

        <span v-if="errorCondition">
            <span class="form-error" v-if="error">{{ error }}</span>
        </span>
    </div>
</template>
