<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextoUtil from "@/Util/TextoUtil";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    empresas: {
        type: Array
    }
})

const destroirEmpresa = (id) => {
    Inertia.delete(route('empresa.destroy', id));
}

const formatarEndereco = (empresa) => {
    if(!empresa.cep) return "";
    let endereco = empresa.logradouro + ', ' + empresa.numero;
    endereco += (empresa.complemento ? ' - ' + empresa.complemento : '') + '<br/>';
    endereco += empresa.bairro + '<br/>';
    endereco += empresa.cidade + '-' + empresa.uf + ' | ' + TextoUtil.formatarParaCEP(empresa.cep);
    return endereco
}

</script>

<template>
    <AppLayout>
        <div class="navbar bg-base-200 rounded-xl mb-4 px-6">
            <div class="flex-1">
                <a class="normal-case text-xl font-bold">Empresas</a>
            </div>
            <div class="flex-none gap-2">
                <a class="btn btn-primary gap-2" :href="route('empresa.create')">
                    <i class="fa-solid fa-add"></i>
                    Adicionar
                </a>
                <!-- <div class="form-control">
                    <input type="text" placeholder="Search" class="input input-bordered" />
                </div>
                <button class="btn btn-primary btn-square gap-2">
                    <i class="fa-solid fa-search"></i>
                </button> -->
            </div>
        </div>
        <div class="bg-base-100 mb-4">
            <div class="overflow-x-auto w-full">
                <table class="table table-compact w-full">
                    <thead>
                        <tr>
                            <th class="w-[114px]"></th>
                            <th class="hidden sm:table-cell">CNPJ</th>
                            <th class="">Nome</th>
                            <th class="hidden sm:table-cell">Contatos</th>
                            <th class="hidden sm:table-cell">Endereço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="empresa in empresas" :key="empresa.id">
                            <td class="border-r">
                                <div class="btn-group">
                                    <a :href="route('empresa.show', empresa)" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-file"></i></a>
                                    <a :href="route('empresa.edit', empresa)" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-edit"></i></a>
                                    <a @click="destroirEmpresa(empresa.id)" class="btn btn-sm btn-outline btn-square"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                            <td class="border-r w-[160px] hidden sm:table-cell">{{ TextoUtil.formatarParaCNPJ(empresa.cnpj) }}</td>
                            <td class="border-r">
                                <div class="flex items-center space-x-3">
                                    <div class="avatar">
                                        <div class="w-10 h-10">
                                            <img :src="empresa.logo ? empresa.logo : 'https://ui-avatars.com/api/?name=' + (empresa.nome_fantasia ? empresa.nome_fantasia : empresa.razao_social)" alt="Avatar Tailwind CSS Component" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ empresa.nome_fantasia ? empresa.nome_fantasia : empresa.razao_social }}</div>
                                        <div v-if="empresa.nome_fantasia" class="text-sm hidden sm:block">{{ empresa.razao_social }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-r hidden sm:table-cell">
                                <div>
                                    <div class="text-xs">{{ empresa.email }}</div>
                                    <div class="text-xs">{{ TextoUtil.formatarParaTelefone(empresa.telefone) }}</div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell">
                                <div>
                                    <div class="text-xs" v-html="formatarEndereco(empresa)">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
