<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TimeUtil from '@/../util/time.util'
import {ref} from "vue";

const props = defineProps({
    production_orders: Array
})

const tabActive = ref('in_production')

</script>

<template>
    <AppLayout>
        <template #header>
            Ordem de Produção
        </template>
        <template #actions>
            <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.create'})" :href="route('production_order.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid grid-cols-5 mb-2 tabs">
            <a class="tab tab-bordered tab-xs h-12 sm:h-8" :class="{'tab-active': tabActive === 'in_production'}" @click="() => tabActive = 'in_production'">Em Produção</a>
            <a class="tab tab-bordered tab-xs h-12 sm:h-8" :class="{'tab-active': tabActive === 'draft'}" @click="() => tabActive = 'draft'">Rascunho</a>
            <a class="tab tab-bordered tab-xs h-12 sm:h-8" :class="{'tab-active': tabActive === 'waiting'}" @click="() => tabActive = 'waiting'">Prontos para Produção</a>
            <a class="tab tab-bordered tab-xs h-12 sm:h-8" :class="{'tab-active': tabActive === 'done'}" @click="() => tabActive = 'done'">Finalizados</a>
            <a class="tab tab-bordered tab-xs h-12 sm:h-8" :class="{'tab-active': tabActive === 'canceled'}" @click="() => tabActive = 'canceled'">Cancelados</a>
        </div>
        <div class="grid sm:grid-cols-4 gap-2">
            <template v-for="production_order in production_orders" :key="production_order.id">
                <a v-if="production_order.status === tabActive" :href="route('production_order.show', production_order.id)" class="card w-full bg-base-100 shadow-xl p-2">
                    <div class="flex items-center space-x-3">
                        <div class="avatar placeholder">
                            <div v-if="production_order.status === 'draft'" class="bg-base-200 rounded-full w-6">
                                <span></span>
                            </div>
                            <div v-if="production_order.status === 'waiting'" class="bg-blue-500 rounded-full w-6">
                                <span></span>
                            </div>
                            <div v-if="production_order.status === 'in_production'" class="bg-warning rounded-full w-6">
                                <span></span>
                            </div>
                            <div v-if="production_order.status === 'done'" class="bg-success rounded-full w-6">
                                <span></span>
                            </div>
                            <div v-if="production_order.status === 'canceled'" class="bg-error rounded-full w-6">
                                <span></span>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="font-bold">{{ production_order.id }}</div>
                            <div class="text-sm opacity-50">{{ TimeUtil.toFormatedString(production_order.created_at) }}</div>
                            <progress class="progress w-full" :value="production_order.progress" max="100"></progress>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </AppLayout>
</template>
