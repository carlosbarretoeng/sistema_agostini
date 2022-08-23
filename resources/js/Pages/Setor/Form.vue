<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

const emit = defineEmits(['refresh'])

const props = defineProps({
    empresaId: {
        type: Number
    },
    formSetor: {
        type: Object,
        default: () => null
    }
})
</script>

<template>
    <div>
        <div class="form-control w-full sm:col-span-4">
            <label class="label">
                <span class="label-text uppercase font-bold">Nome</span>
            </label>
            <input type="text" class="input input-bordered w-full" placeholder="Nome" v-model="formSetor.nome"/>
        </div>
        <div class="form-control w-full sm:col-span-4">
            <label class="label">
                <span class="label-text uppercase font-bold">Descrição</span>
            </label>
            <textarea class="textarea input-bordered w-full" placeholder="Descrição" v-model="formSetor.descricao"></textarea>
        </div>
    </div>
</template>
