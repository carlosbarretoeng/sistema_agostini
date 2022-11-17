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
    qrcodes: Array,
})

let listaDeQrcode = ref('');
let listaDeProducao = ref('');
let listaDePartsDaOrdemDeProducao = ref('');

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
    let hasQrcode = props.qrcodes.filter(el => el[0] === decodedString)

    listaDeQrcode.value = hasQrcode;
    listaDeProducao.value = hasQrcode.map(el => el[1]);
    listaDePartsDaOrdemDeProducao.value = hasQrcode.map(el => el[2]);

    if(hasQrcode.length) {
        avancar.value = true;
    }else {
        const errorMsg = "Estação de Trabalho ou Etapa inválidos."
        error.value = errorMsg
        setTimeout(() => {
            if(error.value === errorMsg) error.value = ''
        }, 5000)
    }
}

const goToNextStep = () => {
    Inertia.post(route('times.startProduction'), {
        production_order: props.id,
        production_order_parts: listaDePartsDaOrdemDeProducao.value
    });
}

const goToPreviousStep = () => {
    avancar.value = false;
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

        <div v-if="!avancar">
            <h3 class="font-bold text-center text-lg">Verifique a Estação e a Etapa de Trabalho a ser feita</h3>
            <p class="py-4 text-center">Aponte a câmera do celular para o código ao lado da descrição da Estação de Trabalho</p>
            <QrcodeStream @decode="onDecode" @init="onInitCamera"></QrcodeStream>
            <div v-if="error" class="alert alert-error shadow-lg mt-2">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ error }}</span>
                </div>
            </div>
        </div>
        <div v-else>
            <template v-if="listaDeProducao.reduce((older, newer) => older + newer[0], 0) > 0">
                <h3 class="font-bold text-center text-lg">Verifique a sua lista de produção</h3>
                <p class="py-4 text-center">Para realizar essa atividade, você precisará produzir:</p>
                <div>
                    <template v-for="(lista, index) in listaDeProducao" :key="index">
                        <div class="text-center" v-if="lista[0] > 0">{{ lista }}</div>
                    </template>
                </div>
                <p class="py-4 text-center">Ao clicar em 'Avançar', abaixo, o tempo de produção começará a contar.</p>
            </template>
            <template v-else>
                <h3 class="font-bold text-center text-lg">A Etapa de Produção já foi concluída</h3>
                <p class="py-4 text-center">Ao clicar em 'Voltar', abaixo, para selecionar uma nova etapa.</p>
            </template>
            <div class="flex flex-col" v-if="listaDeProducao.reduce((older, newer) => older + newer[0], 0) > 0">
                <button @click="goToNextStep()" class="btn btn-primary btn-block my-2">Avançar</button>
            </div>
            <button @click="goToPreviousStep()" class="btn btn-secondary btn-block my-2">Voltar</button>
        </div>
    </AppLayout>
</template>
