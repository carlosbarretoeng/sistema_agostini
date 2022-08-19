<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";
import axios from "axios";
import {Inertia} from "@inertiajs/inertia";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    empresa: {
        type: Object
    },
    podeAdicionar: {
        type: Boolean,
        default: false
    }
})

const formEmpresa = useForm({
    cnpj: props.empresa.cnpj ?? null,
    logo: props.empresa.logo ?? null,
    razao_social: props.empresa.razao_social ?? null,
    nome_fantasia: props.empresa.nome_fantasia ?? null,
    cep: props.empresa.cep,
    logradouro: props.empresa.logradouro,
    numero: props.empresa.numero,
    complemento: props.empresa.complemento,
    bairro: props.empresa.bairro,
    cidade: props.empresa.cidade,
    uf: props.empresa.uf,
    email: props.empresa.email,
    telefone: props.empresa.telefone
})

const disabled = !props.podeAdicionar;

const tab = ref(1);

const salvarEmpresa = () => {
    formEmpresa.post(route('empresa.store'))
}

const conculaReceitaWs = () => {
    const options = {
        method: 'GET',
        url: 'https://receitaws.com.br/v1/cnpj/45631323000111',
        headers: {'Content-Type': 'application/json'}
    };

    axios.request(options).then(function (response) {
        console.log(response.data);
    }).catch(function (error) {
        console.error(error);
    });
}

</script>

<template>
    <AppLayout>
        <div class="navbar bg-base-200 rounded-xl mb-4 px-2 sm:px-6">
            <div class="flex-none gap-2">
                <a class="btn btn-primary gap-2" :class="{ 'btn-square': false }" :href="route('empresa.index')">
                    <i class="fa-solid fa-angle-left"></i>
                    <span class="hidden sm:block">Voltar</span>
                </a>
            </div>
            <div class="divider divider-horizontal hidden sm:block"></div>
            <div class="flex-1">
                <div class="flex items-center space-x-3">
                    <div class="avatar hidden sm:block">
                        <div class="mask mask-squircle w-10 h-10">
                            <img :src="empresa.logo ? empresa.logo : 'https://ui-avatars.com/api/?name=' + (empresa.nome_fantasia ? empresa.nome_fantasia : empresa.razao_social)" alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold">{{ empresa.nome_fantasia ? empresa.nome_fantasia : empresa.razao_social }}</div>
                        <div v-if="empresa.nome_fantasia" class="text-sm hidden sm:block">{{ empresa.razao_social }}</div>
                    </div>
                </div>
            </div>
            <div class="flex-none gap-2" v-if="tab === 0 && !disabled">
                <a class="btn btn-primary gap-2" :class="{ 'btn-square': false }" @click="salvarEmpresa()">
                    <i class="fa-solid fa-save fa-xl"></i>
                    <span class="hidden sm:block">Salvar</span>
                </a>
            </div>
        </div>

        <div class="tabs mb-2 hidden sm:block">
            <a class="tab tab-lifted" :class="{'tab-active': tab === 0}" @click="tab = 0">Dados</a>
            <a class="tab tab-lifted" :class="{'tab-active': tab === 1}" @click="tab = 1">Departamentos</a>
            <a class="tab tab-lifted" :class="{'tab-active': tab === 2}" @click="tab = 2">Setores</a>
            <a class="tab tab-lifted" :class="{'tab-active': tab === 3}" @click="tab = 3">Colaboradores</a>
            <a class="tab tab-lifted" :class="{'tab-active': tab === 4}" @click="tab = 4">Maquinário</a>
            <a class="tab tab-lifted" :class="{'tab-active': tab === 5}" @click="tab = 5">Produtos</a>
        </div>

        <div v-if="tab === 0">
            <div class="bg-base-100 mb-4">
                <div class="overflow-x-auto w-full">
                    <div class="card w-full bg-base-200 shadow mb-4">
                        <div class="p-4 grid sm:grid-cols-11 gap-4">
                            <div class="form-control w-full sm:col-span-3">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">CNPJ</span>
                                </label>
                                <div class="flex">
                                    <input type="text" class="input input-bordered w-full" v-maska="'##.###.###/####-##'" v-model="formEmpresa.cnpj" :disabled="disabled"/>
                                    <!-- <button class="btn btn-square btn-accent ml-4" v-if="!disabled" @click="conculaReceitaWs">
                                        <i class="fa-solid fa-search fa-lg"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="form-control w-full sm:col-span-4">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Razão Social</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.razao_social" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full sm:col-span-4">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Nome Fantasia</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.nome_fantasia" :disabled="disabled"/>
                            </div>
                        </div>
                    </div>

                    <div class="card w-full bg-base-200 shadow mb-4">
                        <div class="p-4 grid sm:grid-cols-11 gap-4">
                            <div class="form-control w-full sm:col-span-2">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">CEP</span>
                                </label>
                                <div class="flex">
                                    <input type="text" class="input input-bordered w-full" v-maska="'##.###-###'" v-model="formEmpresa.cep" :disabled="disabled"/>
                                    <!-- <button class="btn btn-square btn-accent ml-4" v-if="!disabled">
                                        <i class="fa-solid fa-search fa-lg"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="form-control w-full sm:col-span-2">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Logradouro</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.logradouro" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Número</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.numero" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Complemento</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.complemento" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full sm:col-span-2">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Bairro</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.bairro" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full sm:col-span-2">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Cidade</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.cidade" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">UF</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.uf" :disabled="disabled"/>
                            </div>
                        </div>
                    </div>

                    <div class="card w-full bg-base-200 shadow mb-4">
                        <div class="p-4 grid sm:grid-cols-12 gap-4">
                            <div class="form-control w-full sm:col-span-3">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Email de contato</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.email" :disabled="disabled"/>
                            </div>
                            <div class="form-control w-full sm:col-span-3">
                                <label class="label">
                                    <span class="label-text uppercase font-bold">Telefone de contato</span>
                                </label>
                                <input type="text" class="input input-bordered w-full" v-maska="['+## (##) ####-####', '+## (##) #####-####']" v-model="formEmpresa.telefone" :disabled="disabled"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="tab === 1">
            <div class="bg-base-200 mb-4">
                <div class="grid grid-cols-6 gap-4 p-4">
                    <button class="btn btn-ghost btn-block gap-2 border border-base-300 shadow rounded-md">
                        <i class="fa-solid fa-plus fa-lg"></i>
                        Adicionar
                    </button>
                    <div class="border border-base-300 bg-base-100 shadow rounded-md p-2" v-for="i in 0" :key="i">
                        ....
                    </div>
                </div>
            </div>
        </div>

        <div v-if="tab === 2">
            <div class="bg-base-200 mb-4">
                <div class="grid grid-cols-6 gap-4 p-4">
                    <button class="btn btn-ghost btn-block gap-2 border border-base-300 shadow rounded-md">
                        <i class="fa-solid fa-plus fa-lg"></i>
                        Adicionar
                    </button>
                    <div class="border border-base-300 bg-base-100 shadow rounded-md p-2" v-for="i in 0" :key="i">
                        ....
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
