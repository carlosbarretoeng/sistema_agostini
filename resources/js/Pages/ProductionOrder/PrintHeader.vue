<script setup>
import TimeUtil from "@/../util/time.util";
import VueQrcode from '@chenfengyuan/vue-qrcode';

const props = defineProps({
    id: Number,
    company: Object,
    date_start: String,
    date_finish: String,
})

const date_start_formated = TimeUtil.toFormatedString( props.date_start, "DD/MM/YYYY" );
const date_finish_formated = TimeUtil.toFormatedString( props.date_finish, "DD/MM/YYYY" );

</script>

<template>
    <div class="flex gap-2 pb-2 border-b-2 border-black w-full">
        <div class="flex-none">
            <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 100 }"></vue-qrcode>
        </div>
        <div class="flex-1">
            <div class="text-center text-[30px] font-bold">{{ company.name }}</div>
            <div class="text-center text-[20px] font-bold">Ordem de Produção Monitorada - #{{ id }}</div>
            <div class="text-center text-[16px] font-semibold">Início em {{ date_start_formated }} - Término em {{ date_finish_formated }}</div>
        </div>
        <div class="flex-none">
            <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 100 }"></vue-qrcode>
        </div>
    </div>
</template>
