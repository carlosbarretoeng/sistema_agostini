<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CompanyCard from './components/CompanyCard.vue';

const props = defineProps({
    companies: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Empresas
        </template>
        <template #actions>
            <a :href="route('company.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <CompanyCard v-for="company in companies" :key="company.id" v-bind="company"/>
        </div>
    </AppLayout>
</template>