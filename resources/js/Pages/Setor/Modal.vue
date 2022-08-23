<script setup>
import FormSetor from '@/Pages/Setor/Form.vue';
import {useForm} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['refresh'])

const props = defineProps({
    modalId: {
        type: String,
        required: true
    },
    empresaId: {
        type: Number
    },
    setor: {
        type: Object,
        default: () => null
    },
    update: {
        type: Boolean,
        default: false
    }
})

const formSetor = useForm({
    id: props.setor?.id ?? null,
    empresa_id: props.empresaId ?? null,
    nome: props.setor?.nome ?? null,
    descricao: props.setor?.descricao ?? null
})

const loadSetores = () => {
    emit('refresh');
}

const atualizarSetor = () => {
    formSetor.put(route('setor.update', formSetor.id))
    formSetor.reset();
    loadSetores();
}

const salvarSetor = () => {
    formSetor.post(route('setor.store'))
    formSetor.reset();
    loadSetores();
}
</script>

<template>
    <input type="checkbox" :id="modalId" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Novo Setor</h3>
            <FormSetor :formSetor="formSetor" />
            <div class="modal-action">
                <label :for="modalId" class="btn gap-2"><i class="fa-solid fa-cancel fa-xl"></i>Cancelar</label>
                <label v-if="update" :for="modalId" class="btn btn-primary gap-2" @click="atualizarSetor()"><i class="fa-solid fa-arrows-rotate fa-xl"></i>Atualizar</label>
                <label v-else :for="modalId" class="btn btn-primary gap-2" @click="salvarSetor()"><i class="fa-solid fa-save fa-xl"></i>Salvar</label>
            </div>
        </div>
    </div>
</template>
