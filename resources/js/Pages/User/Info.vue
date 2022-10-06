<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputSelect from '@/Components/InputSelect.vue';
import InputText from '@/Components/InputText.vue';
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    context: String,
    thisUser: Object,
    companies: Array,
    roles: Array
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const userHasAppPermission = (app) => {
    return (props.thisUser && props.thisUser.roles[0]) ? (props.thisUser.roles[0].permissions.filter((el) => el.name === 'apps.' + app).length > 0) : false;
}

const form = useForm({
    name: props.thisUser?.name ?? null,
    username: props.thisUser?.username ?? null,
    email: props.thisUser?.email ?? null,
    password: null,
    company_id: props.thisUser?.company_id ?? null,
    role_id: props.thisUser?.roles[0]?.id ?? null,
    apps_times: userHasAppPermission('times'),
    apps_budget: userHasAppPermission('budget'),
    apps_sales: userHasAppPermission('sales'),
    apps_ships: userHasAppPermission('ships'),
    apps_courses: userHasAppPermission('courses'),
})

const formNewPassword = useForm({
    id: props.thisUser?.id,
    password: null,
    retype: null
})

const deleteUser = () => {
    Inertia.delete(route('user.destroy', props.thisUser.id))
}

const updateUser = () => {
    Inertia.put(route('user.update', props.thisUser.id), form)
}

const saveNewUser = () => {
    Inertia.post(route('user.store'), form);
}

const alterarSenha = () => {
    Inertia.put(route('user.passwordUpdate', props.thisUser.id), formNewPassword)
}

</script>

<template>
    <AppLayout>
        <template #header>
            Usuários
        </template>
        <template #actions>
            <a :href="route('user.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a @click="saveNewUser()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="!isCreateContext">
                <a @click="updateUser()" class="btn btn-success mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
                <a v-if="thisUser.id !== $page.props.user.id" @click="deleteUser()" class="btn btn-error gap-2">
                    <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                    <span class="hidden sm:inline-block">Excluir</span>
                </a>
            </template>
        </template>
        <div class="grid gap-2">
            <div class="">
                <div class="card bg-base-100 shadow-xl">
                    <div class="p-2 grid sm:grid-cols-4 gap-2">
                        <div class="col-span-4 sm:col-span-1">
                            <InputText label="Nome" v-model="form.name"/>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputText label="Usuário" v-model="form.username"/>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputText label="Email" v-model="form.email"/>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <a v-if="thisUser" href="#deleteModal" class="btn w-full btn-primary gap-2 sm:mt-9">
                                <font-awesome-icon icon="fa-solid fa-lock" size="lg" />
                                <span class="">Alterar senha</span>
                            </a>
                            <div v-else>
                                <InputText label="Senha" v-model="form.password"/>
                            </div>
                            <div class="modal" id="deleteModal">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Alterar Senha</h3>
                                    <p class="py-4">
                                        <InputText type="password" label="Senha" v-model="formNewPassword.password"/>
                                        <InputText type="password" label="Repita a senha" v-model="formNewPassword.retype"/>
                                    </p>
                                    <div class="modal-action">
                                        <a href="#" class="btn">Cancelar</a>
                                        <a href="#" @click="alterarSenha()" class="btn">Alterar Senha</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputSelect label="Empresa" :options="companies" v-model="form.company_id" :disabled="thisUser?.id === $page.props.user.id"/>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputSelect label="Perfil" :options="roles" v-model="form.role_id" :disabled="thisUser?.id === $page.props.user.id"/>
                        </div>
                        <div class="col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">Aplicativos</span>
                            </label>
                            <div class="grid grid-cols-3 sm:grid-cols-5 form-control mt-1">
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" v-model="form.apps_times" :checked="userHasAppPermission('times')" disabled/>
                                    <span class="label-text flex-1">Tempos</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" v-model="form.apps_budget" :checked="userHasAppPermission('budget')" disabled/>
                                    <span class="label-text flex-1">Custos</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" v-model="form.apps_sales" :checked="userHasAppPermission('sales')" disabled/>
                                    <span class="label-text flex-1">Vendas</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" v-model="form.apps_ships" :checked="userHasAppPermission('ships')" disabled/>
                                    <span class="label-text flex-1">Cargas</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" v-model="form.apps_courses" :checked="userHasAppPermission('courses')" disabled/>
                                    <span class="label-text flex-1">Cursos</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
