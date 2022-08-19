<script setup>
import { Inertia } from '@inertiajs/inertia';
import TextoUtil from '@/Util/TextoUtil';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    company: {
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
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <div class="w-12 h-12">
                            <img :src="company.logo" alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold">{{ company.fantasia }}</div>
                        <div class="text-sm opacity-25">{{ company.nome }}</div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
