<script setup>
import _ from 'lodash';
import AppLayout from '@/Layouts/AppLayout.vue';
import {Chart} from 'highcharts-vue'
import { ref } from 'vue';

const props = defineProps({
    receitas: {
        type: Array,
        default: () => Array.from({length: 12}, () => Math.floor(Math.random() * 1000000))
    },
    despesas: {
        type: Array,
        default: () => Array.from({length: 12}, () => Math.floor(Math.random() * 1000000))
    }
})

const valorReceitas = props.receitas.reduce((older, newer) => older + newer, 0);
const valorDespesas = props.despesas.reduce((older, newer) => older + newer, 0);

const chartOptions = {
    chart: {
        type: 'spline',
        height: window.innerHeight - 410
    },
    credits:{
        enabled: false
    },
    title: {
        text: props.label
    },
    xAxis: {
        categories: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    },
    yAxis: {
        title: {
            text: null
        },
        plotBands: [{ // Light air
            from: -Infinity,
            to: 0,
            color: '#fee2e2'
        }]
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    colors: ['#16a34a', '#dc2626', '#475569'],
    series: [{
        name: 'Rececitas',
        data: props.receitas,
    },{
        name: 'Despesas',
        data: props.despesas,
    },{
        name: 'Resultado',
        data: Array.from({length: props.receitas.length}, (v, k) => {
            return props.receitas[k] - props.despesas[k]
        }),
    }]
}

const moneyFormat = (valor) => {
    return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor)
}

</script>

<template>
    <AppLayout title="Início">
        <div class="grid grid-cols-1 gap-2">
            <div class="stats shadow w-full">

                <div class="stat" style="padding: 0.5rem !important">
                    <div class="stat-title">Receitas dos últimos 12 meses</div>
                    <div class="stat-value text-green-600">{{ moneyFormat(valorReceitas) }}</div>
                </div>

            </div>

            <div class="stats shadow w-full">

                <div class="stat" style="padding: 0.5rem !important">
                    <div class="stat-title">Despesas dos últimos 12 meses</div>
                    <div class="stat-value text-red-600">{{ moneyFormat(valorDespesas) }}</div>
                </div>

            </div>

            <div class="stats shadow w-full">

                <div class="stat" style="padding: 0.5rem !important">
                    <div class="stat-title">Resultado</div>
                    <div class="stat-value text-slate-600 pb-2">{{ moneyFormat(valorReceitas - valorDespesas) }}</div>
                    <Chart :options="chartOptions"/>
                </div>

            </div>

        </div>

        <div class="btm-nav">
            <a :href="route('dashboard.index')" class="active">
                <font-awesome-icon icon="fas fa-home" />
                <span class="btm-nav-label">Início</span>
            </a>
            <a :href="route('plano_de_contas.index')">
                <font-awesome-icon icon="fa-solid fa-square-poll-horizontal" />
                <span class="btm-nav-label">Plano</span>
            </a>
            <a>
                <font-awesome-icon icon="fa-solid fa-list" />
                <span class="btm-nav-label">Extrato</span>
            </a>
            <a>
                <font-awesome-icon icon="fa-solid fa-calculator" />
                <span class="btm-nav-label">Preços</span>
            </a>
        </div>
    </AppLayout>
</template>
