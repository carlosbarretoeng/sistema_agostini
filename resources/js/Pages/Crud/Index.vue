<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    label: String,
    routeName: String,
    data: Array | null
})

</script>

<template>
    <AppLayout>
        <template #header>
            {{ label }}
        </template>
        <template #actions>
            <a :href="route(routeName + '.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
    </AppLayout>
</template>
