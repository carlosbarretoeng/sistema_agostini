<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { mask } from 'maska'
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    label: String,
    entity: String,
    descriptionFieldName: String,
    data: Array,
    fields: Object
})

const mobileFields = props.fields.filter(field => field.showInMobile)

const formatarValorPorMascara = (mascara, valor) => {
    return mask(valor, mascara) ?? valor;
}

const buscaNome = (datum, field) => {
    let fieldSplited = field.split(".");
    if(fieldSplited.length === 1) return datum[fieldSplited[0]]
    return datum[fieldSplited[0]][fieldSplited[1]];
}

const destroy = (id) => {
    console.log(id);
    Inertia.delete(route(props.entity + '.destroy', id));
}
</script>
<template>
    <AppLayout>
        <template #header>
            <div class="flex gap-2">
                <div class="flex-1 font-semibold text-xl text-gray-800 pt-3">
                    {{ label }}
                </div>
                <div class="flex-none">
                    <a :href="route(entity + '.create')" class="btn btn-primary gap-2">
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
                        <template
                            v-for="field in fields"
                            :key="field['name'] + '_' + (new Date()).getTime()"
                        >
                            <th
                                :class="{ 'hidden': !field['showInMobile'], 'sm:table-cell': field['showInDesktop'] }"
                                v-if="field['type'] !== 'reference'"
                            >
                                {{ field['label'] }}
                            </th>
                        </template>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="datum in data"
                        :key="entity + '_id_' + datum['id'] + '_' + (new Date()).getTime()"
                    >
                        <td class="w-[110px]">
                            <a :href="route( entity + '.show', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-info" />
                            </a>
                            <a :href="route(entity + '.edit', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-edit" />
                            </a>
                            <label :for="entity + '_id_' + datum['id'] + '_deleteModal'" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </label>

                            <input type="checkbox" :id="entity + '_id_' + datum['id'] + '_deleteModal'" class="modal-toggle" />
                            <div class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Excluir {{ label }}</h3>
                                    <p class="py-4">Essa operação não poderá ser revertida! Tem certeza?</p>
                                    <div class="modal-action">
                                        <label :for="entity + '_id_' + datum['id'] + '_deleteModal'" class="btn">Não</label>
                                        <button @click="destroy(datum['id'])" for="my-modal-6" class="btn">Sim</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <template
                            v-for="field in fields"
                            :key="entity + '_' + field['name'] + '_' + datum['id'] + '_' + (new Date()).getTime()"
                        >
                            <td
                                :class="{ 'hidden': !field['showInMobile'], 'sm:table-cell': field['showInDesktop'] }"
                                v-if="field['type'] !== 'reference'"
                            >
                                <template v-if="field['mask']">
                                    <span v-html="formatarValorPorMascara(field['mask'], datum[field['name']])"/>
                                </template>
                                <template v-else>
                                    {{ datum[field['name']] }}
                                </template>
                            </td>
                        </template>
                    </tr>
                </tbody>
            </table>

            <div class="overflow-x-auto sm:hidden grid grid-cols-1 sm:grid-cols-3 lg:grid-col-6 gap-2">
                <div
                    v-for="datum in data"
                    :key="entity + '_id_' + datum['id'] + '_' + (new Date()).getTime()"
                    class=""
                >
                    <a :href="route(entity + '.show', datum['id'])" class="flex items-center space-x-3 border-2 border-base-300 bg-base-100 p-2">
                        <div class="flex-1">
                            <div class="font-bold">{{ datum[descriptionFieldName] }}</div>
                            <template v-for="(field, index) in mobileFields" :key="entity + '_' + datum['id'] + '_' + index">
                                <div v-if="field.name !== descriptionFieldName" class="text-sm opacity-50">{{ buscaNome(datum,field.name) }}</div>
                            </template>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
