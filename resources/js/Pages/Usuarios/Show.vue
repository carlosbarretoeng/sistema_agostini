<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
const props = defineProps({
    data: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            <div class="flex gap-2">
                <div class="flex-1 font-semibold text-xl text-gray-800 pt-3">
                    Usuários
                </div>
                <div class="flex-none">
                    <a :href="route('usuario.index')" class="btn btn-outline gap-2">
                        <font-awesome-icon icon="fa-solid fa-arrow-left"/>
                        <span class="hidden sm:block">Voltar</span>
                    </a>
                </div>
                <div class="flex-none">
                    <a  class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-edit"/>
                        <span class="hidden sm:block">Editar</span>
                    </a>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto">
            ...
        </div>
    </AppLayout>
</template>
