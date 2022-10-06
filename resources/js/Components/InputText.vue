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
        <input
            :type="type"
            :placeholder="label"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="input input-bordered w-full disabled:border-base-300 disabled:border-1"
            :disabled="disabled"
            v-maska="mask ?? ''"
        />
    </div>
</template>
