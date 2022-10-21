<script setup>
import _ from 'lodash';
import AppLayout from '@/Layouts/AppLayout.vue';
import TimeUtil from '@/../util/time.util';

const props = defineProps({
    production_orders: Array,
    production_orders_started: Array
})

const jaComecado = (productionOrderId) => {
    return _.indexOf(props.production_orders_started, productionOrderId) >= 0;
}

</script>

<template>
    <AppLayout title="Início">
        <div class="">
            <div v-if="production_orders.length === 0">
                <div class="text-center text-2xl font-bold">Sem ordens de produção</div>
            </div>
            <div v-for="(production_order, index) in production_orders" :key="index" class="w-full bg-base-100 shadow-xl mb-4">
                <div class="card-body p-4 grid grid-cols-4">
                    <progress class="progress w-full col-span-4" :value="production_order.progress" max="100"></progress>
                    <div class="text-xl font-bold col-span-4">Ordem Monitorada #{{ production_order.id }}</div>
                    <div class="text-lg font-semibold col-span-2">Data Início:</div>
                    <div class="text-lg text-right col-span-2">{{ TimeUtil.toFormatedString(production_order.date_start, 'DD/MM/YYYY') }}</div>
                    <div class="text-lg font-semibold col-span-2">Data Término:</div>
                    <div class="text-lg text-right col-span-2">{{ TimeUtil.toFormatedString(production_order.date_finish, 'DD/MM/YYYY') }}</div>
                    <div v-if="production_order.status === 'waiting'" class=" col-span-4">
                        <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                            <span>Iniciar</span>
                        </a>
                    </div>
                    <div v-if="production_order.status === 'in_production' && !jaComecado(production_order.id)" class=" col-span-4">
                        <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                            <span>Iniciar</span>
                        </a>
                    </div>
                    <div v-if="production_order.status === 'in_production' && jaComecado(production_order.id)" class=" col-span-4">
                        <a class="btn btn-secondary gap-2 w-full" :href="route('production_order.stop', production_order.id)">
                            <span>Interromper</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
