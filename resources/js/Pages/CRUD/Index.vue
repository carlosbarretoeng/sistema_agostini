<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { mask } from 'maska'

const props = defineProps({
    label: {
        type: String
    },
    entity: {
        type: String
    },
    data: {
        type: Array
    },
    fields: {
        type: Object
    }
})

const formatarValorPorMascara = (mascara, valor) => {
    return mask(valor, mascara) ?? valor;
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
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th class=" w-[110px]"></th>
                        <th
                            v-for="field in fields"
                            :key="field['name'] + '_' + (new Date()).getTime()"
                            :class="{ 'hidden': !field['showInMobile'], 'sm:table-cell': field['showInDesktop'] }"
                        >
                            {{ field['label'] }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="datum in data"
                        :key="entity + '_id_' + datum['id'] + '_' + (new Date()).getTime()"
                    >
                        <td class="btn-group w-[110px]">
                            <a :href="route( entity + '.show', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-info" />
                            </a>
                            <a :href="route(entity + '.edit', datum['id'])" class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-edit" />
                            </a>
                            <a class="btn btn-sm btn-square btn-outline">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </a>
                        </td>
                        <td
                            v-for="field in fields"
                            :key="entity + '_' + field['name'] + '_' + datum['id'] + '_' + (new Date()).getTime()"
                            :class="{ 'hidden': !field['showInMobile'], 'sm:table-cell': field['showInDesktop'] }"
                        >
                            <template v-if="field['mask']">
                                <span v-html="formatarValorPorMascara(field['mask'], datum[field['name']])"/>
                            </template>
                            <template v-else>
                                {{ datum[field['name']] }}
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
