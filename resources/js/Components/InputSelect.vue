<script setup>
    const props = defineProps({
        label: String,
        options: {
            type: Array,
            default: () => []
        },
        modelValue: String | Number,
        disabled: {
            type: Boolean,
            default: false
        }
    })
</script>
<template>
    <div class="form-control w-full">
        <label v-if="label" class="label">
            <span class="label-text font-medium">{{ label }}</span>
        </label>
        <select
            class="select select-bordered w-full disabled:border-base-300 disabled:border-1"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :disabled="disabled"
        >
            <option value="null">---</option>
            <option v-for="(option) in options" :key="option.id" :value="option.id">{{ option.name }}</option>
        </select>
    </div>
</template>
