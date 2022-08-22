<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextoUtil from "@/Util/TextoUtil";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    colaboradores: {
        type: Array
    }
})
</script>

<template>
    <div class="navbar bg-base-200 rounded-xl mb-4 px-6">
        <div class="flex-1">
            <a class="normal-case text-xl font-bold">Setores</a>
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
                        <th class=""></th>
                        <th class="">Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="empresa in empresas" :key="empresa.id">
                        <td>
                            <div class="btn-group">
                                <a :href="route('empresa.show', empresa)" class="btn btn-sm btn-outline btn-square btn-primary"><i class="fa-solid fa-file"></i></a>
                                <a @click="destroirEmpresa(empresa.id)" class="btn btn-sm btn-outline btn-square btn-secondary"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                        <td class="hidden sm:table-cell">{{ TextoUtil.formatarParaCNPJ(empresa.cnpj) }}</td>
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
</template>
