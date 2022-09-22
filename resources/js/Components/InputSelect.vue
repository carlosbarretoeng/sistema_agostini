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
        <label class="label">
            <span class="label-text font-medium">{{ label }}</span>
        </label>
        <select
            class="select select-bordered w-full disabled:border-base-300 disabled:border-1"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :disabled="disabled"
        >
            <template v-if="options.length === 0">
                <option disabled selected>---</option>
            </template>
            <template v-else>
                <option v-if="options.length > 1" disabled :selected="options.length > 1">Selecione uma opção</option>
                <option v-for="(option) in options" :key="option.id" :value="option.id" :selected="options.length === 1">{{ option.name }}</option>
            </template>
        </select>
    </div>
</template>
