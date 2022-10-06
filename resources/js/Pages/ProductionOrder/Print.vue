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

const estacoesDeTrabalho = props.production_order_parts.map((estacao) => {
    return estacao.product_recipe
})

</script>

<template>
    <div class="overflow-x-auto bg-white w-[21cm]">
        <PrintHeader :id="id" :company="company" :date_start="date_start" :date_finish="date_finish" />
        <div class="grid grid-cols-5 gap-2 mb-2">
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
        <div v-if="production_order_products.length">
            <div class="grid grid-cols-5 gap-2 bg-base-300 rounded-t-md">
                <div class="col-span-4 p-2 font-semibold">
                    Produto
                </div>
                <div class="p-2 text-center font-semibold">
                    Quantidade
                </div>
            </div>
            <template v-for="(product) in production_order_products" :key="product.id">
                <div class="grid grid-cols-5 gap-2 border-b-2">
                    <div class="col-span-4 p-2">
                        {{product.product.name}}
                    </div>
                    <div class="p-2 text-center">
                        {{product.quantity}}
                    </div>
                </div>
            </template>
        </div>
        <div v-if="production_order_parts.length">
            <div class="grid grid-cols-5 gap-2 bg-base-300 rounded-t-md">
                <div class="col-span-3 p-2 font-semibold">
                    Etapa de Trabalho
                </div>
                <div class="p-2 font-semibold text-center">
                    Quantidade
                </div>
                <div class="p-2 font-semibold text-center">
                    Realizado
                </div>
            </div>
            <template v-for="(part) in production_order_parts" :key="part.id">
                <div class="grid grid-cols-5 gap-2 border-b-2">
                    <div class="col-span-3 p-2">
                        {{part.product_recipe?.part.name}}
                    </div>
                    <div class="p-2 text-center">
                        {{part.quantity}}
                    </div>
                    <div class="p-2 text-center">
                        {{part.done}}
                    </div>
                </div>
            </template>

            <br/>

            <PrintHeader :id="id" :company="company" :date_start="date_start" :date_finish="date_finish" />

            <div class="grid grid-cols-5 gap-2 rounded-t-md">
                <div class="col-span-5 p-2 font-semibold bg-base-300 ">
                    <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 50 }"></vue-qrcode> Marcenaria - Serra de bancaada 1
                </div>

                <div class="flex col-span-5 m-4">
                    <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 50 }"></vue-qrcode>
                    <div class="col-span-5">
                        <span class=" font-semibold">51x Sofás de teste</span>
                        <br/>
                        <span class="">204x Pés de sofá padrão</span>
                    </div>
                </div>

                <div class="flex col-span-5 m-4">
                    <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 50 }"></vue-qrcode>
                    <div class="col-span-5">
                        <span class=" font-semibold">1x Cama King Size</span>
                        <br/>
                        <span class="">1x Cabeceira de Cama King Size</span>
                    </div>
                </div>

            </div>







        </div>
    </div>
</template>
