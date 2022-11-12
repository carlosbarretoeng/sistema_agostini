<script setup>
import { Pie } from 'vue-chartjs'
import _ from 'lodash'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement,
    CategoryScale
} from 'chart.js'

import 'chartjs-adapter-moment';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    ArcElement,
    CategoryScale
)

const props = defineProps({
    label: String,
    chartData: Array | Object
})

const backgroundColor = ['#1e3a8a', '#1d4ed8', '#3b82f6', '#93c5fd', '#dbeafe', '#a5b4fc', '#6366f1'];

const cData = {
    labels: Object.keys(props.chartData),
    datasets: [
        {
            backgroundColor,
            data: Object.values(props.chartData)
        }
    ]
}

const cOptions = {
    plugins: {
      legend: {
        position: 'bottom'
      },
      title: {
        display: true,
        text: props.label
      }
    },
    responsive: true,
    maintainAspectRatio: true
}
</script>
<template>
    <Pie
        :chartData="cData"
        :chartOptions="cOptions"
    />
</template>
