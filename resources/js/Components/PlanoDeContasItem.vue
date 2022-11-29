<script setup>
import PlanoDeContasItem from '@/Components/PlanoDeContasItem.vue';
import numberUtil from '@/../util/number.util.js'
const props = defineProps({
    plano_de_conta: Object,
    items: Array,
    level: {
        type: Number,
        default: 0
    }
})

const filtroPlanoDeContas = (superior) => {
    return props.items.filter((val, idx) => val.superior === superior)
}

</script>
<template>
    <div class="flex border-b border-base-300">
        <div v-for="l in level" class="flex-none w-4" />
        <div class="flex-1">
            {{ plano_de_conta.identificador }}. {{ plano_de_conta.descricao }}
        </div>
        <div v-if="plano_de_conta.totalizar" class="flex-none w-32 text-right">
            {{ numberUtil.moneyFormat(plano_de_conta.meta) }}
        </div>
        <div v-if="plano_de_conta.totalizar" class="flex-none w-32 text-right">
            {{ numberUtil.moneyFormat(plano_de_conta.acumulado) }}
        </div>
        <div v-if="plano_de_conta.totalizar" class="flex-none w-32 text-right">
            {{ numberUtil.moneyFormat(plano_de_conta.acumulado - plano_de_conta.meta) }}
        </div>
    </div>
    <div v-for="(plano) in filtroPlanoDeContas(plano_de_conta.id)" :key="new Date().toString()">
        <PlanoDeContasItem :plano_de_conta="plano" :items="items" :level="level + 1"/>
    </div>
</template>
