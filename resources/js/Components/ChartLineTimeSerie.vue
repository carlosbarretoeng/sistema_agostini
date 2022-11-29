<script setup>
import moment from 'moment'
import 'moment/locale/pt-br.js'
import {Chart} from 'highcharts-vue'

const props = defineProps({
    label: String,
    chartData: Array | Object
})

const chartOptions = {
    chart: {
        type: 'spline',
        height: 250
    },
    credits:{
        enabled: false
    },
    title: {
        text: props.label
    },
    xAxis: {
        categories: props.chartData.map((element) => {
            return moment(element.datetime, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY HH:mm')
        })
    },
    yAxis: {
        title: {
            text: null
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        data: props.chartData.map((element) => {
            return element.value
        }),
    }]
}

</script>
<template>
    <Chart
        :options="chartOptions"
    />
</template>
