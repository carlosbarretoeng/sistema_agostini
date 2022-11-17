<script setup>
import {ref} from 'vue';
import moment from 'moment';
import AppLayout from '@/Layouts/AppLayout.vue';
import ChartLineTimeSerie from "@/Components/ChartLineTimeSerie.vue";
import ChartPie from "@/Components/ChartPie.vue";

const props = defineProps({
    department_number: Number,
    product_number: Number,
    machinery_number: Number,
    production_order_number: Number,
    users_number: Number,
    tempos: Array
})

let temposDeProducao = ref([]);

let motivosDePardas = ref([
    ['Almoço', 0],
    ['Café', 0],
    ['Limpeza', 0],
    ['Regulagem da máquina', 0],
    ['Banheiro', 0],
    ['Busca de insumos, ferramentas, etc.', 0],
]);

props.tempos.forEach((el) => {
    if(el.type === 'Produção') {
        let simplifiedDate = moment(el.datetime).format('DD/MM/YYYY HH:00')
        let position = temposDeProducao.value.findIndex(element => element.datetime === simplifiedDate )
        console.log(position)
        if( position < 0){
            temposDeProducao.value.push({ datetime: simplifiedDate, value: el.value });
        } else {
            temposDeProducao.value[position].value += el.value;
        }
    } else {
        motivosDePardas.value[motivosDePardas.value.findIndex((element) => element[0] === el.type)][1] += el.value
    }
})

</script>

<template>
    <AppLayout title="Início">
        <div class="grid sm:grid-cols-5 gap-2 mb-2">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Departamentos</div>
                    <div class="stat-value">{{ department_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Produtos</div>
                    <div class="stat-value">{{ product_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Estações de Trabalho</div>
                    <div class="stat-value">{{ machinery_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Ordens de Produção</div>
                    <div class="stat-value">{{ production_order_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Usuários</div>
                    <div class="stat-value">{{ users_number }}</div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-4 sm:col-span-1 shadow">
                <ChartPie label="Motivos de Parada" :chartData="motivosDePardas"/>
            </div>
            <div class="col-span-4 sm:col-span-3 shadow">
                <ChartLineTimeSerie label="Tempo médio de produção YTD" :chartData="temposDeProducao"/>
            </div>
        </div>
    </AppLayout>
</template>
