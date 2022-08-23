<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextoUtil from "@/Util/TextoUtil";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    setores: {
        type: Array
    }
})

const teste = () => {
    console.log("TESTE")
}
</script>

<template>
    <Teleport to="#contextActions">
        <a class="btn btn-primary gap-2" :class="{ 'btn-square': false }" @click="teste()">
            <i class="fa-solid fa-save fa-xl"></i>
            <span class="hidden sm:block">Salvar</span>
        </a>
    </Teleport>
    <div class="bg-base-100 mb-4">
        <div class="overflow-x-auto w-full grid grid-cols-6 gap-2">
            <div v-for="setor in setores" :key="setor.id" class="card card-compact bg-base-200 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">{{ setor.nome }}</h2>
                    <p>{{ setor.descricao }}</p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-xs btn-primary">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
