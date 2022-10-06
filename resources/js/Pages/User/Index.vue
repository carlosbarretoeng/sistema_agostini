<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'

const props = defineProps({
    users: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Usuários
        </template>
        <template #actions>
            <a :href="route('user.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-3 gap-2">
            <template v-for="user in users" :key="user.id">
                <a :href="route('user.show', user.id)" class="card w-full bg-base-100 shadow-xl p-2">
                    <div class="flex items-center space-x-3 border-b-2 border-base-200 pb-2 mb-1">
                        <div class="avatar">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                    <img :src="user.profile_photo_url" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{ user.name }}</div>
                            <div class="text-sm font-semibold">{{ user.username ?? '---'}}</div>
                            <div class="text-sm font-semibold">{{ user.email ?? '---'}}</div>
                            <div class="text-sm">{{ user.company?.name ?? '---' }}</div>
                        </div>
                    </div>
                    <div>
                        <template v-for="role in user.roles" :key="role.id">
                            <div
                                class="badge badge-sm"
                                :class="{ 'badge-primary': role.name === 'super-admin', 'badge-secondary': role.name === 'admin', 'badge-accent': role.name === 'colaborator' }"
                            >
                                {{ role.name }}
                            </div>
                        </template>
                    </div>
                </a>
            </template>
        </div>
    </AppLayout>
</template>
