<script setup>
import {Chart} from 'highcharts-vue'

const props = defineProps({
    label: String,
    chartData: Array
})

const chartOptions = {
    chart: {
        type: 'pie',
        height: 250
    },
    credits:{
        enabled: false
    },
    title: {
        text: props.label
    },
    plotOptions: {
        pie: {
            dataLabels: {
                enabled: false
            },
        }
    },
    series: [{
        name: props.label,
        colorByPoint: true,
        data: props.chartData.map(el => {
            return {
                name: el[0],
                y: el[1]
            }
        })
        // data: [{
        //     name: 'Chrome',
        //     y: 70.67,
        // }, {
        //     name: 'Other',
        //     y: 2.6
        // }]
    }]
}

</script>
<template>
    <Chart
        :options="chartOptions"
    />
</template>
