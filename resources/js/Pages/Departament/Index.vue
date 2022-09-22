<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DepartamentCard from './components/DepartamentCard.vue';

const props = defineProps({
    departaments: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Departamentos
        </template>
        <template #actions>
            <a :href="route('departament.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <DepartamentCard v-for="departament in departaments" :key="departament.id" v-bind="departament"/>
        </div>
    </AppLayout>
</template>
