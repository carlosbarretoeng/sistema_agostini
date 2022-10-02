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
    CategoryScale
} from 'chart.js'

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    LineElement,
    LinearScale,
    PointElement,
    CategoryScale
)

const props = defineProps({
    label: String | null,
    chartData: Array | String | null
})

const cData = {
    labels: _.takeRight(props.chartData.map((key,value) => Object.keys(key)[0]), 12),
    datasets: [
        {
            label: props.label,
            data: _.takeRight(props.chartData.map((key,value) => Object.values(key)[0]), 12),
        }
    ]
}

const cOptions = {
    plugins: {
        legend: {
            display: false
        }
    },
    responsive: true,
    maintainAspectRatio: false
}
</script>
<template>
    <Line
        :width="100"
        :height="100"
        :chartData="cData"
        :chartOptions="cOptions"
    />
</template>
