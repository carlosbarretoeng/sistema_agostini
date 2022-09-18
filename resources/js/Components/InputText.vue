<script setup>
    const props = defineProps({
        label: String,
        modelValue: String | Number,
        disabled: {
            type: Boolean,
            default: false
        }
    })
</script>
<template>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text font-medium">{{ label }}</span>
        </label>
        <input 
            type="text" 
            :placeholder="label" 
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="input input-bordered w-full disabled:border-base-300 disabled:border-1" 
            :disabled="disabled"
        />
    </div>
</template>