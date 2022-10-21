<script setup>
import { Line } from 'vue-chartjs'
import _ from 'lodash'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    TimeSeriesScale
} from 'chart.js'

import 'chartjs-adapter-moment';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    PointElement,
    LinearScale,
    TimeSeriesScale
)

const props = defineProps({
    label: String,
    chartData: Array
})

console.log()

const cData = {
    labels: props.chartData.map(el => el.datetime),
    datasets: [ {
        label: props.label,
        data: props.chartData.map(el => el.value)
    } ]
}

const cOptions = {
    scales: {
        x: {
            type: 'timeseries',
            time: {
                unit: 'month'
            }
        }
    },
    responsive: true,
    maintainAspectRatio: false
}
</script>
<template>
    <Line
        :width="100"
        :height="300"
        :chartData="cData"
        :chartOptions="cOptions"
    />
</template>
