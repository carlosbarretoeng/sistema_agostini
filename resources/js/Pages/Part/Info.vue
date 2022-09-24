<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from '@/Components/InputText.vue';
import InputSelect from "@/Components/InputSelect.vue";

const props = defineProps({
    context: String,
    id: Number,
    company_id: Number | null,
    name: String,
    companies: Array
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const form = useForm({
    id: props.id ?? null,
    company_id: props.company_id ?? null,
    name: props.name ?? null
})

const destroyPart = () => {
    Inertia.delete(route('part.destroy', props.id));
}

const saveNewPart = () => {
    Inertia.post(route('part.store'), form);
}

const updatePart = () => {
    Inertia.put(route('part.update', props.id), form);
}

</script>

<template>
    <AppLayout>
        <template #header>
            <template v-if="isCreateContext">
                Nova Peça
            </template>
            <template v-if="isShowContext || isEditContext">
                Peça
            </template>
        </template>
        <template #actions>
            <a :href="route('part.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a @click="saveNewPart()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="isEditContext">
                <a @click="updatePart()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
            </template>
            <template v-if="isShowContext">
                <a :href="route('part.edit', id)" class="btn btn-info mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-edit" size="lg" />
                    <span class="hidden sm:inline-block">Editar</span>
                </a>
                <a href="#deleteModal" class="btn btn-error gap-2">
                    <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                    <span class="hidden sm:inline-block">Excluir</span>
                </a>
                <div class="modal" id="deleteModal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Excluir Empresa</h3>
                        <p class="py-4">Tem certeza de que quer excluir essa empresa? Essa operação não poderá ser defeita.</p>
                        <div class="modal-action">
                            <a @click="destroyPart()" class="btn">Sim</a>
                            <a href="#" class="btn">Não</a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <InputSelect label="Empresa" :options="companies" v-model="form.company_id" :disabled="isShowContext" />
            <InputText label="Nome" v-model="form.name" :disabled="isShowContext" />
        </div>
    </AppLayout>
</template>
