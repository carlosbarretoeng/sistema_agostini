<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TimeUtil from '@/../util/time.util'
import InputText from "@/Components/InputText.vue";
import {ref} from "vue";

import { QrcodeStream } from 'vue3-qrcode-reader'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    id: Number,
    company: Object,
    progress: Number,
    status: String,
    date_start: String,
    date_finish: String,
    production_order_products: Array,
    production_order_parts: Array,
})

const date_start_formated = TimeUtil.toFormatedString( props.date_start, "DD/MM/YYYY" );
const date_finish_formated = TimeUtil.toFormatedString( props.date_finish, "DD/MM/YYYY" );

let avancar = ref(false);
let error = ref(null);

const onInitCamera = async (promise) => {
    try {
        await promise
    } catch (error) {
        if (error.name === 'NotAllowedError') {
            error.value = "ERROR: you need to grant camera access permission"
        } else if (error.name === 'NotFoundError') {
            error.value = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
            error.value = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
            error.value = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
            error.value = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
            error.value = "ERROR: Stream API is not supported in this browser"
        } else if (error.name === 'InsecureContextError') {
            error.value = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
        } else {
            error.value = `ERROR: Camera error (${error.name})`;
        }
    }
}

const onDecode = (decodedString) => {
    console.log(decodedString, 'company.' + props.company.id + '.production_order.' + props.id)
    const espectedString = 'company.' + props.company.id + '.production_order.' + props.id;
    if(decodedString === espectedString) {
        avancar.value = true;
    }else {
        const errorMsg = "Ordem de Produção errada."
        error.value = errorMsg
        setTimeout(() => {
            if(error.value === errorMsg) error.value = ''
        }, 5000)
    }
}

const goToNextStep = () => {
    Inertia.get(route('production_order.confirmMachinery', props.id));
}

</script>

<template>
    <AppLayout>
        <template #header>
            Iniciar Ordem de Produção
        </template>
        <template #actions>
            <a :href="route('dashboard.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
        </template>
        <div class="grid grid-cols-2 gap-2 px-2 mb-2">
            <div>
                <InputText label="Data de Início" v-model="date_start_formated" disabled/>
            </div>
            <div>
                <InputText label="Data de Término" v-model="date_finish_formated" disabled/>
            </div>
        </div>

        <label for="checkProductionOrderModal" class="btn btn-primary btn-block mb-2 gap-2">
            <span>Validar</span>
        </label>

        <input type="checkbox" id="checkProductionOrderModal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-center text-lg">Verifique a Ordem de Produção</h3>
                <p class="py-4 text-center">Aponte a câmera do celular para o código no canto superior da página</p>
                <QrcodeStream @decode="onDecode" @init="onInitCamera"></QrcodeStream>
                <div v-if="error" class="alert alert-error shadow-lg mt-2">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ error }}</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <button @click="goToNextStep()" class="btn btn-primary btn-block my-2" :disabled="!avancar">Avançar</button>
                    <label for="checkProductionOrderModal" class="btn btn-secondary btn-block" @click="onInitCamera">Cancelar</label>
                </div>
            </div>
        </div>

        <div class="">
            <div class="col-span-2 bg-base-300 rounded-t-md p-2 font-semibold">
                Produto
            </div>

            <div v-for="(production_order_product) in production_order_products" :key="'pop_' + production_order_product.id" class="col-span-2 p-2 text-sm">
                {{ production_order_product.quantity }}x {{ production_order_product.product.name }}
            </div>

        </div>

        <div class="">
            <div class="col-span-2 bg-base-300 p-2 font-semibold">
                Etapas de Produto
            </div>

            <template v-for="(production_order_part, index) in production_order_parts" :key="'pop_' + production_order_part.id">
                <div class="col-span-2 p-2 text-sm" :class="{'bg-white/75': index % 2, 'line-through': !(production_order_part.quantity - production_order_part.done)}">
                    {{ production_order_part.quantity - production_order_part.done }}x {{ production_order_part.product_recipe.part.name }}
                </div>
            </template>

        </div>

        <div class="">
            <div class="col-span-2 bg-base-300 rounded-b-md p-2 font-semibold">
            </div>
        </div>

    </AppLayout>
</template>
