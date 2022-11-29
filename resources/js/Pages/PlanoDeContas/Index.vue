<script setup>
import PlanoDeContasItem from '@/Components/PlanoDeContasItem.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'
import numberUtil from '@/../util/number.util.js'

const props = defineProps({
    plano_de_contas: Array
})

const filtroPlanoDeContas = (superior) => {
    return props.plano_de_contas.filter((val, idx) => val.superior === superior)
}

</script>

<template>
    <AppLayout>
        <template #header>
            Plano de Contas
        </template>

        <div class="flex">
            <div class="flex-1">
                Item do Plano
            </div>
            <div class="flex-none w-32 text-right">
                Meta
            </div>
            <div class="flex-none w-32 text-right">
                Acumulado
            </div>
            <div class="flex-none w-32 text-right">
                Diferença
            </div>
        </div>
        <div>&nbsp;</div>
        <div>
            <div v-for="(plano) in filtroPlanoDeContas(null)" :key="new Date().toString()">
                <PlanoDeContasItem :plano_de_conta="plano" :items="plano_de_contas" :level="0"/>
                <div>&nbsp;</div>
            </div>
        </div>

        <div class="btm-nav" v-if="AuthUtil.canView($page.props.user, { role: 'app_custos' })">
            <a :href="route('dashboard.index')">
                <font-awesome-icon icon="fas fa-home" />
                <span class="btm-nav-label">Início</span>
            </a>
            <a :href="route('plano_de_contas.index')" class="active">
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
