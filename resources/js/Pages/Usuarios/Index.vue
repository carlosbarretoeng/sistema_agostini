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

        <div class="overflow-x-auto">
            <table class="table table-compact w-full hidden sm:table">
                <thead>
                <tr>
                    <th class=" w-[110px]"></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Perfil</th>
                </tr>
                </thead>
                    <tbody>
                    <tr
                        v-for="datum in data"
                        :key="'usuario_id_' + datum['id'] + '_' + (new Date()).getTime()"
                    >
                        <td class="w-[110px]">
                            <a :href="route( 'usuario.show', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-info" />
                            </a>
                            <a :href="route('usuario.edit', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-edit" />
                            </a>
                            <label :for="'usuario_id_' + datum['id'] + '_deleteModal'" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </label>

                            <input type="checkbox" :id="'usuario_id_' + datum['id'] + '_deleteModal'" class="modal-toggle" />
                            <div class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Excluir Usuário</h3>
                                    <p class="py-4">Essa operação não poderá ser revertida! Tem certeza?</p>
                                    <div class="modal-action">
                                        <label :for="'usuario_id_' + datum['id'] + '_deleteModal'" class="btn">Não</label>
                                        <button @click="destroy(datum['id'])" for="my-modal-6" class="btn">Sim</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ datum['name'] }}</td>
                        <td>{{ datum['email'] }}</td>
                        <td>.</td>
                        <td>
                            <template
                                v-for="role in datum['roles']"
                                :key="'usuario_id_' + datum['id'] + '_role_' + role['id'] + '_' + (new Date()).getTime()"
                            >
                                <span class="badge mr-2">{{ role.name }}</span>
                            </template>
                        </td>
                    </tr>
                    </tbody>

<!--                <tbody>-->
<!--                <tr-->
<!--                    v-for="datum in data"-->
<!--                    :key="entity + '_id_' + datum['id'] + '_' + (new Date()).getTime()"-->
<!--                >-->
<!--                    <td class="w-[110px]">-->
<!--                        <a :href="route( entity + '.show', datum['id'])" class="btn btn-sm btn-square btn-outline">-->
<!--                            <font-awesome-icon icon="fa-solid fa-info" />-->
<!--                        </a>-->
<!--                        <a :href="route(entity + '.edit', datum['id'])" class="btn btn-sm btn-square btn-outline">-->
<!--                            <font-awesome-icon icon="fa-solid fa-edit" />-->
<!--                        </a>-->
<!--                        <label :for="entity + '_id_' + datum['id'] + '_deleteModal'" class="btn btn-sm btn-square btn-outline">-->
<!--                            <font-awesome-icon icon="fa-solid fa-trash" />-->
<!--                        </label>-->

<!--                        <input type="checkbox" :id="entity + '_id_' + datum['id'] + '_deleteModal'" class="modal-toggle" />-->
<!--                        <div class="modal modal-bottom sm:modal-middle">-->
<!--                            <div class="modal-box">-->
<!--                                <h3 class="font-bold text-lg">Excluir {{ label }}</h3>-->
<!--                                <p class="py-4">Essa operação não poderá ser revertida! Tem certeza?</p>-->
<!--                                <div class="modal-action">-->
<!--                                    <label :for="entity + '_id_' + datum['id'] + '_deleteModal'" class="btn">Não</label>-->
<!--                                    <button @click="destroy(datum['id'])" for="my-modal-6" class="btn">Sim</button>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </td>-->
<!--                    <td-->
<!--                        v-for="field in fields"-->
<!--                        :key="entity + '_' + field['name'] + '_' + datum['id'] + '_' + (new Date()).getTime()"-->
<!--                        :class="{ 'hidden': !field['showInMobile'], 'sm:table-cell': field['showInDesktop'] }"-->
<!--                    >-->
<!--                        <template v-if="field['mask']">-->
<!--                            <span v-html="formatarValorPorMascara(field['mask'], datum[field['name']])"/>-->
<!--                        </template>-->
<!--                        <template v-else>-->
<!--                            {{ datum[field['name']] }}-->
<!--                        </template>-->
<!--                    </td>-->
<!--                </tr>-->
<!--                </tbody>-->
            </table>

            <div
                v-for="datum in data"
                :key="'usuario_id_' + datum['id'] + '_' + (new Date()).getTime()"
                class="sm:hidden gap-4"
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
                    <div>
                        <a :href="route('usuario.create')" class="btn btn-ghost gap-2">
                            <font-awesome-icon icon="fa-solid fa-edit"/>
                        </a>
                        <a :href="route('usuario.create')" class="btn btn-ghost gap-2">
                            <font-awesome-icon icon="fa-solid fa-trash"/>
                        </a>
                    </div>
                </a>
            </div>
        </div>
    </AppLayout>
</template>
