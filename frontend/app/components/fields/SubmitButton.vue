<script setup>
const props = defineProps({
    text: {
        type: String,
        default: 'Button'
    },
    loading: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
    loadingText: {
        type: String,
        default: 'Processing'
    },
    className: String
})
</script>

<template>
    <button type="Login" :disabled="disabled || loading"
    class="px-4 py-2 rounded cursor-pointer transition disabled:cursor-not-allowed disabled:opacity-60 bg-blue-500 text-white hover:bg-blue-600" :class="className">
        <span v-if="loading" class="flex items-center justify-center gap-2 relative">
            <span>{{ loadingText }}</span>
            <Icon name="line-md:loading-alt-loop" class="text-xl animate-spin" />
        </span>

        <span v-else>{{ text }}</span>
    </button>
</template>
