<script setup>
import {reactive, ref} from "vue";

const props = defineProps({
    label: String,
    colSpan: Number,
    type: {
        type: String,
        default: 'string'
    },
    mask: String | null,
    value: String | Number,
    disabled: {
        type: Boolean,
        default: false
    }
})

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
    const regexToReplace = props.mask ? new RegExp("[" + props.mask.replaceAll('#','') + "]", "g") : null;
    return regexToReplace ? event.target.value.replaceAll(regexToReplace, '') : event.target.value;
}

</script>
<template>
    <div :class="calculateClass">
        <div class="form-control w-full p-1">
            <label class="label">
                <span class="label-text font-medium">{{ label }}</span>
            </label>
            <input
                v-maska="mask"
                :type="type === 'string' ? 'text' : 'number'"
                class="input input-bordered w-full disabled:border-1 disabled:border-gray-400"
                v-model.lazy="value"
                @input="$emit('update', fetchValue($event))"
                :disabled="disabled"
            />
        </div>
    </div>
</template>
