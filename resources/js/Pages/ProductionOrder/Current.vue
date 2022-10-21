<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
})

</script>

<template>
    <AppLayout>
        <template #header>
            Iniciar Ordem de Produção
        </template>
        <template #actions>
            <a :href="route('dashboard.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
        </template>
        ....
    </AppLayout>
</template>
