<script setup>
import _ from 'lodash';
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import {onMounted, ref} from "vue";
import axios from "axios";

import ModalColaborador from '@/Pages/Colaborador/Modal.vue';

const props = defineProps({
    empresaId: {
        type: Number
    }
})

let setores = ref([]);
let colaboradores = ref([]);

const formSetor = useForm({
    id: null,
    empresa_id: props.empresaId ?? null,
    nome: null,
    descricao: null
})

const salvarSetor = () => {
    formSetor.post(route('setor.store'))
    formSetor.reset();
    loadSetores();
}

const destroirColaborador = (id) => {
    Inertia.delete(route('setor.destroy', id));
    loadSetores()
}

const loadSetores = async () => {
    const data = _.values((await axios.get(route('setor.index'), { params: { empresa_id: props.empresaId}})).data)
    setores.value = data
    const setoresIds = data.map(el => el.id)
    colaboradores.value = (await axios.get(route('colaborador.index'), { params: { setor_ids: setoresIds }})).data
}

onMounted(async () => {
    await loadSetores()
})

</script>

<template>
    <Teleport to="#contextActions">
        <label for="adicionarColaboradorModal" class="btn btn-primary gap-2 modal-button">
            <i class="fa-solid fa-add fa-xl"></i>
            <span class="hidden sm:block">Adicionar</span>
        </label>
        <ModalColaborador modalId="adicionarColaboradorModal" @refresh="loadSetores"/>


    </Teleport>
    <div class="bg-base-100 mb-4">
        <div class="overflow-x-auto w-full grid grid-cols-1 sm:grid-cols-6 gap-2">
            <div v-if="colaboradores.length" v-for="colaborador in colaboradores" :key="colaborador.id" class="card card-compact bg-base-200 shadow-xl">
                <div class="card-body">
                    <pre>{{ colaborador }}</pre>
                    <h2 class="card-title">{{ colaborador.name }}</h2>
                    <p>{{ colaborador.email }}</p>
                    <div class="card-actions justify-end">
                        <label :for="'setor' + colaborador.id" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-edit"></i></label>
                        <!-- <ModalSetor :modalId="'setor' + setor.id" :empresaId="empresaId" :setor="setor" update @refresh="loadSetores"/> -->

                        <a @click="destroirColaborador(colaborador.id)" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div v-else class="sm:col-span-6">
                <div class="font-medium">Nenhum colaborador cadastrado</div>
            </div>
        </div>
    </div>
</template>
