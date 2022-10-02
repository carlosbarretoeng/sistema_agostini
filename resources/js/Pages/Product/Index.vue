<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'

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
            <a v-if="AuthUtil.canView($page.props.user, {permission: 'product.create'})" :href="route('product.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <template v-for="product in products" :key="product.id">
                <a :href="route('product.show', product.id)" class="card w-full bg-base-100 shadow-xl p-2">
                    <div class="flex items-center space-x-3">
                        <div class="avatar placeholder">
                            <div class="bg-neutral-focus text-neutral-content rounded-full w-12">
                                <span>{{ TextUtil.initials(product.name) }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{ product.name }}</div>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </AppLayout>
</template>
