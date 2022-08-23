<script setup>
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";
import {onMounted, ref} from "vue";
import ModalSetor from "@/Pages/Setor/Modal.vue";
import axios from "axios";

const props = defineProps({
    empresaId: {
        type: Number
    }
})

let setores = ref([]);

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

const destroirSetor = (id) => {
    Inertia.delete(route('setor.destroy', id));
    loadSetores()
}

const loadSetores = async () => {
    const data = (await axios.get(route('setor.index'), { params: { empresa_id: props.empresaId}})).data
    setores.value = data
}

onMounted(async () => {
    await loadSetores()
})

</script>

<template>
    <Teleport to="#contextActions">
        <label for="adicionarSetorModal" class="btn btn-primary gap-2 modal-button">
            <i class="fa-solid fa-add fa-xl"></i>
            <span class="hidden sm:block">Adicionar</span>
        </label>
        <ModalSetor modalId="adicionarSetorModal" :empresaId="empresaId" @refresh="loadSetores"/>


    </Teleport>
    <div class="bg-base-100 mb-4">
        <div class="overflow-x-auto w-full grid grid-cols-1 sm:grid-cols-6 gap-2">
            <div v-if="setores" v-for="setor in setores" :key="setor.id" class="card card-compact bg-base-200 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">{{ setor.nome }}</h2>
                    <p>{{ setor.descricao }}</p>
                    <div class="card-actions justify-end">
                        <label :for="'setor' + setor.id" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-edit"></i></label>
                        <ModalSetor :modalId="'setor' + setor.id" :empresaId="empresaId" :setor="setor" update @refresh="loadSetores"/>

                        <a @click="destroirSetor(setor.id)" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <div v-else class="sm:col-span-6">
                <div class="font-medium">Nenhum setor cadastrado</div>
            </div>
        </div>
    </div>
</template>
