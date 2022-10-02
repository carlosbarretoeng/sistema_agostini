<script setup>
import ChartLine from '@/Components/ChartLine.vue'
const props = defineProps({
    stats: Array
})
</script>
<template>
    <div class="grid sm:grid-cols-4 gap-2">
        <template v-for="(stat, index) in stats" :key="index">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">{{ stat.label }}</div>
                    <div class="stat-value">{{ stat.value }}</div>
                    <ChartLine v-if="stat.chartData" :chartData="stat.chartData"/>
                </div>
            </div>
        </template>
    </div>
</template>
