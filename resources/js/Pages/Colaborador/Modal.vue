<script setup>
import FormEmpresa from '@/Pages/Empresa/Form.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['refresh'])

const props = defineProps({
    modalId: {
        type: String,
        required: true
    },
    empresa: {
        type: Object,
        default: () => null
    },
    setores: {
        type: Array,
        default: () => []
    },
    update: {
        type: Boolean,
        default: false
    }
})

const formEmpresa = useForm({
    id: null,
    cpf: null,

})

const loadSetores = () => {
    // emit('refresh');
}

const atualizarEmpresa = () => {
    formEmpresa.telefone = formEmpresa.telefone.replace(/[\s-\(\)]/g, "");
    console.log(formEmpresa.telefone)
    formEmpresa.put(route('empresa.update', formEmpresa.id))
    formEmpresa.reset();
    loadSetores();
}

const salvarSetor = () => {
    formEmpresa.post(route('empresa.store'))
    formEmpresa.reset();
    loadSetores();
}
</script>

<template>
    <input type="checkbox" :id="modalId" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg">Novo Colaborador</h3>
            <!-- <FormEmpresa :formEmpresa="formEmpresa" :readOnly="false"/> -->
            <div class="modal-action">
                <label :for="modalId" class="btn gap-2"><i class="fa-solid fa-cancel fa-xl"></i>Cancelar</label>
                <label v-if="update" :for="modalId" class="btn btn-primary gap-2" @click="atualizarEmpresa()"><i class="fa-solid fa-arrows-rotate fa-xl"></i>Atualizar</label>
                <label v-else :for="modalId" class="btn btn-primary gap-2" @click="salvarSetor()"><i class="fa-solid fa-save fa-xl"></i>Salvar</label>
            </div>
        </div>
    </div>
</template>
