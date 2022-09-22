<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import MachineryCard from './components/MachineryCard.vue';

const props = defineProps({
    machineries: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Maquinário
        </template>
        <template #actions>
            <a :href="route('machinery.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <MachineryCard v-for="machinery in machineries" :key="machinery.id" v-bind="machinery"/>
        </div>
    </AppLayout>
</template>
