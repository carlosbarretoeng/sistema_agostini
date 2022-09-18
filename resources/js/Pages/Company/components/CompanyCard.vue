<script setup>
import TextUtil from '@/../util/text.util'

const props = defineProps({
    id: Number,
    name: String
})

</script>
<template>
    <a :href="route('company.show', id)" class="card w-full bg-base-100 shadow-xl p-2">
        <div class="flex items-center space-x-3">
            <div class="avatar placeholder">
                <div class="bg-neutral-focus text-neutral-content rounded-full w-12">
                    <span>{{ TextUtil.initials(name) }}</span>
                </div>
            </div>
            <div>
                <div class="font-bold">{{ name }}</div>
            </div>
        </div>
    </a>
</template>