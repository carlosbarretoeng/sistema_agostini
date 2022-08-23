<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {ref} from "vue";

import EmpresaDadosComponent from "@/Pages/Empresa/EmpresaDadosComponent.vue";
import SetorIndexComponent from '@/Pages/Setor/IndexComponent.vue';

const props = defineProps({
    empresa: {
        type: Object
    },
    readOnly: {
        type: Boolean,
        default: true
    }
})

const tab = ref(0);

</script>

<template>
    <AppLayout>
        <div class="navbar bg-base-200 rounded-xl mb-4 px-2 sm:px-6">
            <div class="flex-none gap-2 pr-4">
                <a class="btn btn-primary gap-2" :href="route('empresa.index')">
                    <i class="fa-solid fa-angle-left"></i>
                    <span class="hidden sm:block">Voltar</span>
                </a>
            </div>
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
            <div id="contextActions" class="flex-none justify-end bg-red-100"></div>
        </div>

        <div v-if="tab === 0">
            <EmpresaDadosComponent :empresa="empresa" :readOnly="readOnly"/>
        </div>

    </AppLayout>
</template>
