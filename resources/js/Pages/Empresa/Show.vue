<script setup>
import CrudShow from '@/Pages/CRUD/Show.vue';

const props = defineProps({
    label: {
        type: String
    },
    entity: {
        type: String
    },
    fields: {
        type: Array
    },
    data: {
        type: Object
    }
})
</script>

<template>
    <CrudShow
        :label="label"
        :entity="entity"
        :fields="fields"
        :data="data"
    >
    </CrudShow>
</template>

