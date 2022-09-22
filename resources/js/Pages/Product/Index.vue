<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductCard from './components/ProductCard.vue';

const props = defineProps({
    products: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Produto
        </template>
        <template #actions>
            <a :href="route('product.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <ProductCard v-for="product in products" :key="product.id" v-bind="product"/>
        </div>
    </AppLayout>
</template>
