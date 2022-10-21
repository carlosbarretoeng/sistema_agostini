<script setup>
import _ from 'lodash';
import TimeUtil from "@/../util/time.util";
import VueQrcode from '@chenfengyuan/vue-qrcode';
import InputText from "@/Components/InputText.vue";
import PrintHeader from "./PrintHeader.vue";

const props = defineProps({
    id: Number,
    company: Object,
    progress: Number,
    status: String,
    date_start: String,
    date_finish: String,
    production_order_products: Array,
    production_order_parts: Array,
    production_order_actions: Array,
})

const date_start_formated = TimeUtil.toFormatedString( props.date_start, "DD/MM/YYYY" );
const date_finish_formated = TimeUtil.toFormatedString( props.date_finish, "DD/MM/YYYY" );

const workStations = props.production_order_parts.reduce((older, newer) => {
    let departmentName = newer.product_recipe.part.machinery.department.name;
    let machineryName = newer.product_recipe.part.machinery.name;
    let partName = newer.product_recipe.part.name;

    let companyId = newer.product_recipe.product.company_id;
    let departmentId = newer.product_recipe.part.machinery.department.id;
    let machineryId = newer.product_recipe.part.machinery.id;
    let partId = newer.product_recipe.part.id;

    let departmentPos = 0;
    let machineryPos = 0;
    let partPos = 0;

    if(!older.filter(el => el.departmentId === departmentId).length){
        older.push({
            departmentId,
            departmentName,
            machineries: []
        })
    }

    older.forEach(el => {
        if(el.departmentId === departmentId){
            if(!el.machineries.filter(ell => ell.machineryId === machineryId).length){
                el.machineries.push({
                    machineryId,
                    machineryName,
                    machineryQrcode: 'company.' + companyId + '.department.' + departmentId + '.machinery.' + machineryId,
                    parts: []
                })
            }

            el.machineries.forEach(ell => {
                if(ell.machineryId === machineryId){
                    if(!ell.parts.filter(elll => elll.partId === partId).length){
                        ell.parts.push({
                            partId,
                            partName,
                            partQrcode: 'company.' + companyId + '.department.' + departmentId + '.machinery.' + machineryId + '.part.' + partId,
                            quantity: 0,
                            done: 0
                        })
                    }
                }
            })
        }
    })

    departmentPos = _.findIndex(older, el => el.departmentId === departmentId)
    machineryPos = _.findIndex(older[departmentPos].machineries, el => el.machineryId === machineryId)
    partPos = _.findIndex(older[departmentPos].machineries[machineryPos].parts, el => el.partId === partId)

    older[departmentPos].machineries[machineryPos].parts[partPos].quantity += newer.quantity;
    older[departmentPos].machineries[machineryPos].parts[partPos].done += newer.done;

    console.log(older)
    return older
}, [])

</script>

<template>
    <div class="bodyToPrint">
        <div class="w-[21cm] bg-white">
            <table class="report-container w-full">
                <thead class="report-header">
                <tr>
                    <th class="report-header-cell">
                        <div class="header-info">
                            <PrintHeader :id="id" :company="company" :date_start="date_start" :date_finish="date_finish" />
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody class="report-content">
                <tr>
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 gap-2 bg-base-300 rounded-t-md">
                            <div class="col-span-6 p-2 font-semibold">
                                Produto
                            </div>
                            <div class="p-2 text-center font-semibold">
                                Quantidade
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-for="(product) in production_order_products" :key="product.id">
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 border-base-300">
                            <div class="col-span-6 p-2 text-sm">
                                {{product.product.name}}
                            </div>
                            <div class="p-2 text-center text-sm">
                                {{product.quantity}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-5 gap-2 bg-base-300 rounded-b-md mb-2">&nbsp;</div>
                    </td>
                </tr>

                <tr>
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 gap-2 bg-base-300 rounded-t-md">
                            <div class="col-span-3 p-2 font-semibold">
                                Etapa de Trabalho
                            </div>
                            <div class="col-span-2 p-2 font-semibold text-center">
                                Produto
                            </div>
                            <div class="p-2 font-semibold text-center">
                                Quantidade
                            </div>
                            <div class="p-2 font-semibold text-center">
                                Realizado
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-for="(part) in production_order_parts" :key="part.id">
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 gap-2">
                            <div class="col-span-3 p-2 text-sm">
                                {{part.product_recipe?.part.name}}
                            </div>
                            <div class="col-span-2 p-2 text-sm text-center">
                                {{part.product_recipe?.product.name}}
                            </div>
                            <div class="p-2 text-center">
                                {{part.quantity}}
                            </div>
                            <div class="p-2 text-center">
                                {{part.done}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 gap-2 bg-base-300 rounded-b-md">
                            <div class="col-span-5 p-2 font-semibold">
                                Total
                            </div>
                            <div class="p-2 font-semibold text-center">
                                {{ production_order_parts.reduce((older, newer) => { return older + newer.quantity}, 0) }}
                            </div>
                            <div class="p-2 font-semibold text-center">
                                {{ production_order_parts.reduce((older, newer) => { return older + newer.done}, 0) }}
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <template v-for="(workStation, idx) in workStations" :key="idx">
            <template v-for="(machinery, idxx) in workStation.machineries" :key="idxx">
                <div class="w-[21cm] bg-white mt-2">
                    <table class="report-container w-full">
                        <thead class="report-header">
                        <tr>
                            <th class="report-header-cell">
                                <div class="header-info hidden print:block">
                                    <PrintHeader :id="id" :company="company" :date_start="date_start" :date_finish="date_finish" />
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="report-content">
                        <tr>
                            <td class="report-content-cell px-2">
                                <div class="main">
                                    <div class="">
                                        <div class="flex gap-2 bg-base-300 rounded-md">
                                            <div class="flex-none p-2">
                                                <vue-qrcode  :value="machinery.machineryQrcode" :options="{ width: 100 }"></vue-qrcode>
                                            </div>
                                            <div class="flex flex-col grow justify-center items-left font-semibold">
                                                <div class="py-4 border-b-4 border-base-200">{{ workStation.departmentName }} - {{ machinery.machineryName }}</div>
                                                <div class="grid grid-cols-7 gap-2 bg-base-300">
                                                    <div class="col-span-5 p-2 font-semibold">
                                                        Etapa de Trabalho
                                                    </div>
                                                    <div class="p-2 font-semibold text-center">
                                                        Quantidade
                                                    </div>
                                                    <div class="p-2 font-semibold text-center">
                                                        Realizado
                                                    </div>
                                                </div>
                                                <div v-for="(part, idxxx) in machinery.parts" :key="idxxx" class="font-normal">
                                                    <div class="report-content-cell">
                                                        <div class="main">
                                                            <div class="grid grid-cols-7 gap-2">
                                                                <div class="col-span-5 p-2">
                                                                    {{ part.partName }}
                                                                </div>
                                                                <div class="p-2 text-center">
                                                                    {{ part.quantity }}
                                                                </div>
                                                                <div class="p-2 text-center">
                                                                    {{ part.done }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </template>
    </div>
</template>

<style >
    body {
        background: white !important;
    }
    table.report-container {
        page-break-after:always;
    }
    thead.report-header {
        display:table-header-group;
    }
    tfoot.report-footer {
        display:table-footer-group;
    }
    .bodyToPrint{
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    @media print {
        .bodyToPrint {
            width: 21cm;
            display: inline;
        }
    }
</style>
