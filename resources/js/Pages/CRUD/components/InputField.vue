<script setup>
import {reactive, ref} from "vue";

const props = defineProps({
    label: String,
    colSpan: Number,
    mask: String | null,
    val: String
})

const val = ref(props.val);

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

</script>
<template>
    <div :class="calculateClass">
        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">{{ label }}</span>
            </label>
            <input
                v-maska="mask"
                type="text"
                class="input input-bordered w-full"
                v-model="val"
                @input="$emit('update', $event.target.value)"
            />
        </div>
        </div>
</template>
