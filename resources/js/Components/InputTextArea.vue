<script setup>
    const props = defineProps({
        label: String,
        type: String,
        modelValue: String | Number,
        disabled: {
            type: Boolean,
            default: false
        },
        mask: String
    })
</script>
<template>
    <div class="form-control w-full">
        <label v-if="label" class="label">
            <span class="label-text font-medium">{{ label }}</span>
        </label>
        <textarea
            :placeholder="label"
            :value="modelValue"
            rows="3"
            @input="$emit('update:modelValue', $event.target.value)"
            class="textarea textarea-bordered w-full disabled:border-base-300 disabled:border-1"
        ></textarea>
    </div>
</template>
