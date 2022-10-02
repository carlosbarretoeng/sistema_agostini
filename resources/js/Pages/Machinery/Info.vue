<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from '@/Components/InputText.vue';
import InputSelect from "@/Components/InputSelect.vue";
import AuthUtil from '@/../util/auth.util';
import {computed} from "vue";

const props = defineProps({
    context: String,
    id: Number,
    company_id: Number | null,
    department_id: Number,
    name: String,
    companies: Array,
    departments: Array
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const form = useForm({
    id: props.id ?? null,
    company_id: props.company_id ?? null,
    department_id: props.department_id ?? null,
    name: props.name ?? null
})

let filteredDepartments = computed(() => {
    let options = props.departments.filter((department) => {
        console.log('' + department.company_id, form.company_id, department.company_id === form.company_id)
        return ('' + department.company_id) === '' + form.company_id
    })
    console.log(options)
    return options
})

const destroyMachinery = () => {
    Inertia.delete(route('machinery.destroy', props.id));
}

const saveNewMachinery = () => {
    Inertia.post(route('machinery.store'), form);
}

const updateMachinery = () => {
    Inertia.put(route('machinery.update', props.id), form);
}

</script>

<template>
    <AppLayout>
        <template #header>
            <template v-if="isCreateContext">
                Nova Estação de Trabalho
            </template>
            <template v-if="isShowContext || isEditContext">
                Estação de Trabalho
            </template>
        </template>
        <template #actions>
            <a :href="route('machinery.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'machinery.create'})" @click="saveNewMachinery()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="isEditContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'machinery.update'})" @click="updateMachinery()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
            </template>
            <template v-if="isShowContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'machinery.update'})" :href="route('machinery.edit', id)" class="btn btn-info mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-edit" size="lg" />
                    <span class="hidden sm:inline-block">Editar</span>
                </a>
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'machinery.delete'})" href="#deleteModal" class="btn btn-error gap-2">
                    <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                    <span class="hidden sm:inline-block">Excluir</span>
                </a>
                <div class="modal" id="deleteModal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Excluir Empresa</h3>
                        <p class="py-4">Tem certeza de que quer excluir essa empresa? Essa operação não poderá ser defeita.</p>
                        <div class="modal-action">
                            <a @click="destroyMachinery()" class="btn">Sim</a>
                            <a href="#" class="btn">Não</a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <InputSelect label="Empresa" :options="companies" v-model="form.company_id" :disabled="isShowContext" />
            <InputSelect label="Departamento" :options="filteredDepartments" v-model="form.department_id" :disabled="isShowContext" />
            <InputText label="Nome" v-model="form.name" :disabled="isShowContext" />
        </div>
    </AppLayout>
</template>
