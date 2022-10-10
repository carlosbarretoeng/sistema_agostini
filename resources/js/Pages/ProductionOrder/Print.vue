<script setup>
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

const estacoesDeTrabalho = props.production_order_parts.reduce((older, newer) => {
    let department = newer.product_recipe.part.machinery.department.name;
    let machinery = newer.product_recipe.part.machinery.name;
    let part = newer.product_recipe.part.name;

    if(Object.keys(older).indexOf(department) < 0){
        older[department] = {}
    }

    if(Object.keys(older[department]).indexOf(machinery) < 0){
        older[department][machinery] = {}
    }

    if(Object.keys(older[department][machinery]).indexOf(part) < 0){
        older[department][machinery][part] = {
            quantity: 0,
            done: 0
        }
    }

    older[department][machinery][part]['quantity'] += newer.quantity
    older[department][machinery][part]['done'] += newer.done

    console.log(older)
    return older
}, {})

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
                    <td class="report-content-cell">
                        <div class="grid grid-cols-5 gap-2 px-2 mb-2">
                            <div>
                                <InputText label="Identificador" v-model="id" disabled/>
                            </div>
                            <div>
                                <InputText label="Data de Início" v-model="date_start_formated" disabled/>
                            </div>
                            <div>
                                <InputText label="Data de Início" v-model="date_finish_formated" disabled/>
                            </div>
                            <div>
                                <InputText label="Status" v-model="status" disabled/>
                            </div>
                            <div>
                                <InputText label="Progresso" v-model="progress" disabled/>
                            </div>
                        </div>
                    </td>
                </tr>

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
                            <div class="col-span-6 p-2">
                                {{product.product.name}}
                            </div>
                            <div class="p-2 text-center">
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
                    </td>
                </tr>
                <tr v-for="(part) in production_order_parts" :key="part.id">
                    <td class="px-2 report-content-cell">
                        <div class="grid grid-cols-7 gap-2">
                            <div class="col-span-5 p-2">
                                {{part.product_recipe?.part.name}}
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

        <template v-for="(estacaoDeTrabalho, departamento, indice) in estacoesDeTrabalho" :key="indice">
            <template v-for="(partDeOrdem, estDeTrabalho, indice2) in estacaoDeTrabalho" :key="indice2">
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
                                        <div class="flex gap-2 bg-base-300 rounded-t-md">
                                            <div class="flex-none p-2">
                                                <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 50 }"></vue-qrcode>
                                            </div>
                                            <div class="flex grow items-center font-semibold">
                                                {{ departamento }} - {{ estDeTrabalho }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="report-content-cell px-2">
                                <div class="main">
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
                                </div>
                            </td>
                        </tr>
                        <tr v-for="(data, part, indice3) in partDeOrdem" :key="indice3">
                            <td class="report-content-cell px-2">
                                <div class="main">
                                    <div class="grid grid-cols-7 gap-2">
                                        <div class="p-2">
                                            <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 50 }"></vue-qrcode>
                                        </div>
                                        <div class="col-span-4 leading-[50px] p-2">
                                            {{ part }}
                                        </div>
                                        <div class="p-2 leading-[50px] text-center">
                                            {{ data.quantity }}
                                        </div>
                                        <div class="p-2 leading-[50px] text-center">
                                            {{ data.done }}
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
