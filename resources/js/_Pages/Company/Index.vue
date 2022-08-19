<script setup>
import { Inertia } from '@inertiajs/inertia';
import TextoUtil from '@/Util/TextoUtil';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    companies: {
        type: Object,
        default: () => []
    }
})

const editarEmpresa = (id) => {
    console.log("Editar " + id)
    Inertia.visit('/company/' + id)
}

const deletarEmpresa = (id) => {
    console.log("DELETOU " + id)
    Inertia.visit('/company')
}
</script>

<template>
    <AppLayout title="Dashboard">


        <div class="navbar bg-base-100 shadow rounded-box mb-4">
            <div class="flex-1">
                <span class="btn btn-ghost normal-case text-xl">Empresas</span>
            </div>
            <div class="flex-none gap-2 hidden md:flex">
                <div class="form-control">
                    <input type="text" placeholder="Procurar..." class="input input-bordered" />
                </div>
                <button class="btn btn-ghost btn-circle">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto shadow rounded-box mb-4">
            <table class="table table-compact w-full text-sm">
                <thead>
                    <tr>
                        <th class="bg-base-300 w-2"></th>
                        <th class="bg-base-300">Nome</th>
                        <th class="bg-base-300 w-40">Contatos</th>
                        <th class="bg-base-300 w-32">Endereço</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="company in companies" :key="company.id">
                        <td class="">
                            <button @click.prevent="editarEmpresa(company.id)" class="btn btn-sm btn-circle btn-outline btn-primary mr-2">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <label :for="'deleteModal' + company.id" class="btn btn-sm btn-circle btn-outline btn-secondary modal-button hover:text-white">
                                <i class="fa-solid fa-trash"></i>
                            </label>
                            <input type="checkbox" :id="'deleteModal' + company.id" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box  w-6/12 max-w-5xl">
                                    <div class="w-full whitespace-pre-line font-bold">
                                        Você realmente deseja excluir a empresa abaixo? Essa operação não
                                        poderá ser desfeita posteriormente.
                                    </div>
                                    <br/>
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12">
                                                <img :src="company.logo" alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold opacity-50">{{ TextoUtil.formatarParaCNPJ(company.cnpj) }}</div>
                                            <div class="font-bold">{{ company.fantasia }}</div>
                                            <div class="text-sm opacity-25">{{ company.nome }}</div>
                                        </div>
                                    </div>
                                    <div class="modal-action">
                                        <label @click.prevent="deletarEmpresa(company.id)" class="btn btn-success">Sim!</label>
                                        <label :for="'deleteModal' + company.id" class="btn btn-error">Não</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <div class="w-12 h-12">
                                        <img :src="company.logo" alt="Avatar Tailwind CSS Component" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold opacity-50">{{ TextoUtil.formatarParaCNPJ(company.cnpj) }}</div>
                                    <div class="font-bold">{{ company.fantasia }}</div>
                                    <div class="text-sm opacity-25">{{ company.nome }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="text-sm opacity-50"><a :href="'mailto:' + company.email">{{ company.email }}</a></div>
                                <div class="text-sm opacity-50"><a :href="'tel:+55' + company.telefone">{{ TextoUtil.formatarParaTelefone(company.telefone) }}</a></div>
                            </div>
                        </td>
                        <td>
                            <a :href="'https://www.google.com.br/maps?q=' + company.cep" target="_blank">
                                <div class="text-sm opacity-50">{{ company.logradouro }}, {{ company.numero }} - {{ company.complemento }}</div>
                                <div class="text-sm opacity-50">{{ company.bairro }}, {{ company.cidade }} / {{ company.uf }}</div>
                                <div class="text-sm opacity-50">{{ TextoUtil.formatarParaCEP(company.cep) }}</div>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
