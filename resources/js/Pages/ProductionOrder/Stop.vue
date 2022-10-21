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

const flagInterrupcao = ref(false)

const form = useForm({
    production_order_id: props.id,
    motivo: ref(null),
    obs: ref(null),
    quantidades: props.production_order_parts.map(el => { return {'production_order_parts_id': el.id, quantidade: 0}; })
})

const incrementPart = (index) => {
    form.quantidades[index].quantidade++
}

const decrementPart = (index) => {
    form.quantidades[index].quantidade--
}

const finalizar = () => {
    Inertia.post(route('times.finalizar'), form);
}

const interromper = () => {
    Inertia.post(route('times.interrupt'), form);
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
        <div v-if="!flagInterrupcao">
            <h3 class="font-bold text-center text-lg">Selecione uma das opções</h3>

            <div class="mt-4">
                <button class="btn btn-primary gap-2 w-full" @click="finalizar()">
                    <span>Terminei a Ordem de Produção</span>
                </button>
            </div>

            <div class="divider">OU</div>

            <div class="mt-4">
                <button class="btn btn-primary gap-2 w-full" @click="() => flagInterrupcao = true">
                    <span>Preciso interromper por enquanto</span>
                </button>
            </div>
        </div>

        <div v-else>
            <h3 class="font-bold text-center text-lg">Adicione mais informações</h3>

            <InputSelect label="Motivo da Interrupção" :options="motivos" v-model="form.motivo"/>



            <table class="table table-compact w-full my-2">
                <thead>
                <tr>
                    <th class="bg-base-300">O que você já produziu?</th>
                    <th class="w-1/6 text-center bg-base-300">Quantidade</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(production_order_part, index) in production_order_parts" :key="index">
                    <td>{{production_order_part.quantity - production_order_part.done}}x {{production_order_part.product_recipe.part.name}} para {{production_order_part.product_recipe.product.name}}</td>
                    <td class="text-center">
                        <div class="form-control">
                            <label class="input-group w-full justify-center">
                                <button @click="decrementPart(index)" class="btn btn-sm btn-ghost" :disabled="form.quantidades[index].quantidade <= 0">
                                    <font-awesome-icon icon="fa-solid fa-minus" />
                                </button>
                                <span> {{ form.quantidades[index].quantidade }}</span>
                                <button @click="incrementPart(index)" class="btn btn-sm btn-ghost" :disabled="form.quantidades[index].quantidade >= (production_order_part.quantity - production_order_part.done)">
                                    <font-awesome-icon icon="fa-solid fa-plus" />
                                </button>
                            </label>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <InputTextArea label="Observações importantes" v-model="form.obs"/>

            <div class="mt-4">
                <button class="btn btn-primary gap-2 w-full" @click="interromper()" :disabled="form.motivo == null || form.motivo == 'null'">
                    <span>Registrar</span>
                </button>
            </div>
        </div>

    </AppLayout>
</template>
