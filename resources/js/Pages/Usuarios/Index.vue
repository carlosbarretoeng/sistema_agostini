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
                    <a :href="route('usuario.create')" class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-add"/>
                        <span class="hidden sm:block">Adicionar</span>
                    </a>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto grid grid-cols-1 sm:grid-cols-3 lg:grid-col-6 gap-2">
            <div
                v-for="datum in data"
                :key="'usuario_id_' + datum['id'] + '_' + (new Date()).getTime()"
                class=""
            >
                <a :href="route('usuario.show', datum['id'])" class="flex items-center space-x-3 border-2 border-base-300 bg-base-100 p-2">
                    <div class="avatar">
                        <div class="mask mask-squircle w-12 h-12">
                            <img :src="datum['profile_photo_url']" alt="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="font-bold">{{ datum['name'] }}</div>
                        <div class="text-sm opacity-50">{{ datum['email'] }}</div>
                        <div>
                            <template
                                v-for="role in datum['roles']"
                                :key="'usuario_id_' + datum['id'] + '_role_' + role['id'] + '_' + (new Date()).getTime()"
                            >
                                <span class="badge badge-xs mr-2">{{ role.name }}</span>
                            </template>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </AppLayout>
</template>
