<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TimeUtil from '@/../util/time.util'
import InputTextArea from '@/Components/InputTextArea.vue';
import InputSelect from "@/Components/InputSelect.vue";
import {ref} from "vue";

import { QrcodeStream } from 'vue3-qrcode-reader'
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    id: Number,
    company: Object,
    progress: Number,
    status: String,
    date_start: String,
    date_finish: String,
    production_order_parts: Array,
    motivos: Array
})

const form = useForm({
    production_order_id: props.id,
    motivo: ref(null),
    obs: ref(null),
    quantidades: props.production_order_parts.map(el => { return {'production_order_parts_id': el.id, quantidade: 0}; })
})

const finalizar = () => {
    Inertia.post(route('times.finalizar'), form);
}

</script>

<template>
    <AppLayout>
        <template #header>
            Interromper Ordem de Produção
        </template>
        <template #actions>
            <a :href="route('dashboard.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
        </template>
        <div>
            <h3 class="font-bold text-center text-lg">Finalizar Ordem</h3>

            <div class="text-center text-md">Ao clicar no botão abaixo, você estará informando que finalizou a etapa de produção com todos os itens produzidos!</div>

            <div class="mt-4">
                <button class="btn btn-primary gap-2 w-full" @click="finalizar()">
                    <span>Terminei a Ordem de Produção</span>
                </button>
            </div>
        </div>

    </AppLayout>
</template>
