<script setup>
import _ from 'lodash';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    production_orders: Array,
    ordens_aguardando: Array,
    ordens_producao: Array,
})

const enableIniciarNovo = (prodution_order_id) => {
    return props.ordens_producao.length === 0
}

const enableRetomar = (prodution_order_id) => {
    return !enableIniciarNovo(prodution_order_id) && props.ordens_producao.filter(el => el.type === 'Produção').length === 0;
}

const enableInterromper = (prodution_order_id) => {
    return !enableIniciarNovo(prodution_order_id) && props.ordens_producao.filter(el => el.type === 'Produção').length > 0;
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
                    <div class="text-xl font-bold col-span-4 text-center">Ordem Monitorada #{{ production_order.id }}</div>

                    <div class=" col-span-4" v-if="_.indexOf(ordens_aguardando, production_order.id) > -1">
                        <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                            <span>Iniciar</span>
                        </a>
                    </div>
                    <template v-else>
                        <div class="col-span-4">
                            <div class="text-center font-medium">Você esta executando:</div>
                            <div v-for="(pwot, idx) in ordens_producao" :key="idx" class="text-xs text-center mb-1">
                                <span v-if="production_order.id === pwot.id">{{ pwot.texto }}</span>
                            </div>
                        </div>

                        <div class=" col-span-4" v-if="enableIniciarNovo(production_order.id)">
                            <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                                <span>Iniciar</span>
                            </a>
                        </div>

                        <div class="col-span-4" v-if="enableRetomar(production_order.id)">
                            <a class="btn btn-success gap-2 w-full" :href="route('production_order.start', production_order.id)">
                                <span>Retomar</span>
                            </a>
                        </div>

                        <template v-if="enableInterromper(production_order.id)">
                            <div class="col-span-2">
                                <a class="btn btn-secondary gap-2 w-full" :href="route('production_order.stop', production_order.id)">
                                    <span>Interromper</span>
                                </a>
                            </div>

                            <div class="col-span-2">
                                <a class="btn btn-negative gap-2 w-full" :href="route('production_order.finalize', production_order.id)">
                                    <span>Finalizar</span>
                                </a>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
