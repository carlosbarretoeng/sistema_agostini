<script setup>
import {reactive, ref} from "vue";

const props = defineProps({
    label: String,
    colSpan: Number,
    value: String,
    values: Array | null,
    multiple: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

const selected = ref(props.value)

const calculateClass = reactive({
    'sm:col-span-1': props.colSpan === 1,
    'sm:col-span-2': props.colSpan === 2,
    'sm:col-span-3': props.colSpan === 3,
    'sm:col-span-4': props.colSpan === 4,
    'sm:col-span-5': props.colSpan === 5,
    'sm:col-span-6': props.colSpan === 6,
    'sm:col-span-7': props.colSpan === 7,
    'sm:col-span-8': props.colSpan === 8,
    'sm:col-span-9': props.colSpan === 9,
    'sm:col-span-10': props.colSpan === 10,
    'sm:col-span-11': props.colSpan === 11,
    'sm:col-span-12': props.colSpan === 12,
})

const fetchValue = (event) => {
    return event;
}

</script>
<template>
    <div :class="calculateClass">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text font-medium">{{ label }}</span>
            </label>
            <select
                class="select select-bordered max-w-full disabled:border-1 disabled:border-gray-400"
                v-model.lazy="selected"
                @input="$emit('update', fetchValue($event.target.value))"
                :disabled="disabled"
                :multiple="multiple"
            >
                <option v-if="!multiple" disabled selected></option>
                <option v-for="(val, idx) in values" :key="'option_' + idx" :value="Array.isArray(val) ? val[0] : val ">{{ Array.isArray(val) ? val[1] : val }}</option>
            </select>
        </div>
        </div>
</template>
