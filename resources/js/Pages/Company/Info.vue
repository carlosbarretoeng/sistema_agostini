<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from '@/Components/InputText.vue';
import AuthUtil from '@/../util/auth.util'

const props = defineProps({
    context: String,
    id: Number,
    name: String
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const form = useForm({
    id: props.id ?? null,
    name: props.name ?? null
})

const destroyCompany = () => {
    Inertia.delete(route('company.destroy', props.id));
}

const saveNewCompany = () => {
    Inertia.post(route('company.store'), form);
}

const updateCompany = () => {
    Inertia.put(route('company.update', props.id), form);
}

</script>

<template>
    <AppLayout>
        <template #header>
            <template v-if="isCreateContext">
                Nova Empresa
            </template>
            <template v-if="isShowContext || isEditContext">
                Empresa
            </template>
        </template>
        <template #actions>
            <a :href="route('company.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'company.create'})" @click="saveNewCompany()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="isEditContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'company.update'})" @click="updateCompany()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
            </template>
            <template v-if="isShowContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'company.update'})" :href="route('company.edit', id)" class="btn btn-info mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-edit" size="lg" />
                    <span class="hidden sm:inline-block">Editar</span>
                </a>
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'company.delete'})" href="#deleteModal" class="btn btn-error gap-2">
                    <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                    <span class="hidden sm:inline-block">Excluir</span>
                </a>
                <div class="modal" id="deleteModal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Excluir Empresa</h3>
                        <p class="py-4">Tem certeza de que quer excluir essa empresa? Essa opera????o n??o poder?? ser defeita.</p>
                        <div class="modal-action">
                            <a @click="destroyCompany()" class="btn">Sim</a>
                            <a href="#" class="btn">N??o</a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <InputText label="Nome" v-model="form.name" :disabled="isShowContext" />
        </div>
    </AppLayout>
</template>
