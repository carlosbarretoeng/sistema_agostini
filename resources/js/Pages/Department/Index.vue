<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DepartmentCard from './components/DepartmentCard.vue';

const props = defineProps({
    departments: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Departamentos
        </template>
        <template #actions>
            <a :href="route('department.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <DepartmentCard v-for="department in departments" :key="department.id" v-bind="department"/>
        </div>
    </AppLayout>
</template>
