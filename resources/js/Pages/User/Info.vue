<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputSelect from '@/Components/InputSelect.vue';
import InputText from '@/Components/InputText.vue';
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    thisUser: Object,
    companies: Array,
    roles: Array
})

const form = useForm({
    name: props.thisUser?.name ?? null,
    username: props.thisUser?.username ?? null,
    email: props.thisUser?.email ?? null,
    password: null,
    company_id: props.thisUser?.company_id ?? null,
    role_id: props.thisUser?.roles[0].id ?? null
})

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
            <a @click="updateProduct()" class="btn btn-success gap-2">
                <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                <span class="hidden sm:inline-block">Atualizar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-12 gap-2">
            <div class="sm:col-span-2">
                <div class="card bg-base-100 shadow-xl">
                    <figure>
                        <img class="h-48" :src="thisUser?.profile_photo_url ?? 'https://ui-avatars.com/api/?name=&amp;color=7F9CF5&amp;background=EBF4FF'" alt="Avatar" />
                    </figure>
                    <div class="p-2">
                        <button class="btn btn-block btn-primary">Alterar Imagem</button>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-10">
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
                                    <h3 class="font-bold text-lg">Excluir Empresa</h3>
                                    <p class="py-4">Tem certeza de que quer excluir essa empresa? Essa operação não poderá ser defeita.</p>
                                    <div class="modal-action">
                                        <a @click="destroyProduct()" class="btn">Sim</a>
                                        <a href="#" class="btn">Não</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputSelect label="Empresa" :options="companies" v-model="form.company_id"/>
                        </div>
                        <div class="col-span-4 sm:col-span-1">
                            <InputSelect label="Perfil" :options="roles" v-model="form.role_id"/>
                        </div>
                        <div class="col-span-2">
                            <label class="label">
                                <span class="label-text font-medium">Aplicativos</span>
                            </label>
                            <div class="grid grid-cols-3 sm:grid-cols-5 form-control mt-1">
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" />
                                    <span class="label-text flex-1">Tempos</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" />
                                    <span class="label-text flex-1">Custos</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" />
                                    <span class="label-text flex-1">Vendas</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" />
                                    <span class="label-text flex-1">Cargas</span>
                                </label>
                                <label class="label cursor-pointer space-x-2">
                                    <input type="checkbox" class="checkbox" />
                                    <span class="label-text flex-1">Cursos</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ thisUser }}
        <br/><br/><br/>
        {{ companies }}
        <br/><br/><br/>
        {{ roles }}
    </AppLayout>
</template>
