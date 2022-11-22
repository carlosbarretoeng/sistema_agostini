<script setup>
import _ from 'lodash';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    production_orders: Array,
    productions_with_open_time: Array
})

const productions_with_open_time_ids = _.uniq(props.productions_with_open_time.map(el => el.id));
const productions_with_open_time_type = _.uniq(props.productions_with_open_time.map(el => el.type));

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
                    <!-- <div class="text-lg font-semibold col-span-2">Data Início:</div>
                    <div class="text-lg text-right col-span-2">{{ TimeUtil.toFormatedString(production_order.date_start, 'DD/MM/YYYY') }}</div>
                    <div class="text-lg font-semibold col-span-2">Data Término:</div>
                    <div class="text-lg text-right col-span-2">{{ TimeUtil.toFormatedString(production_order.date_finish, 'DD/MM/YYYY') }}</div> -->
                    <div v-if="production_order.status === 'waiting'" class=" col-span-4">
                        <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                            <span>Iniciar</span>
                        </a>
                    </div>
                    <div v-if="production_order.status === 'in_production' && productions_with_open_time_ids.indexOf(production_order.id) < 0" class=" col-span-4">
                        <a class="btn btn-primary gap-2 w-full" :href="route('production_order.start', production_order.id)">
                            <span>Iniciar</span>
                        </a>
                    </div>
                    <template v-if="production_order.status === 'in_production' && productions_with_open_time_ids.indexOf(production_order.id) > -1">
                        <div class="col-span-4">
                            <div class="text-center font-medium">Você esta executando:</div>
                            <div v-for="(pwot, idx) in productions_with_open_time" :key="idx" class="text-xs text-center mb-1">
                                <span v-if="production_order.id === pwot.id">{{ pwot }}</span>
                            </div>
                        </div>
                        <div class="col-span-2" v-if="productions_with_open_time_type.indexOf('Produção') > -1">
                            <a class="btn btn-secondary gap-2 w-full" :href="route('production_order.stop', production_order.id)">
                                <span>Interromper</span>
                            </a>
                        </div>
                        <div class="col-span-2" v-else>
                            <a class="btn btn-success gap-2 w-full" :href="route('production_order.start', production_order.id)">
                                <span>Retomar</span>
                            </a>
                        </div>
                        <div class="col-span-2">
                            <a class="btn btn-negative gap-2 w-full" :href="route('production_order.stop', production_order.id)">
                                <span>Finalizar</span>
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
