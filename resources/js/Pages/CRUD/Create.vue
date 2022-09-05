<script setup>
import { mask } from 'maska'
import AppLayout from '@/Layouts/AppLayout.vue';
import InputField from "./components/InputField.vue";
import SelectField from "./components/SelectField.vue";

const props = defineProps({
    label: {
        type: String
    },
    entity: {
        type: String
    },
    fields: {
        type: Object
    }
})

const formatarValorPorMascara = (mascara, valor) => {
    return mask(valor, mascara) ?? valor;
}

const calculateClass = (field) => {
    let returnObj = {};

    returnObj['col-span-' + field['colSpan']] = true;

    console.log(field, returnObj);
    return returnObj;
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
                    <a :href="route(entity + '.index')" class="btn btn-outline gap-2">
                        <font-awesome-icon icon="fa-solid fa-arrow-left"/>
                        <span class="hidden sm:block">Voltar</span>
                    </a>
                </div>
                <div class="flex-none">
                    <a :href="route(entity + '.create')" class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-save"/>
                        <span class="hidden sm:block">Salvar</span>
                    </a>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto">
            {{ form }}
            <div class="grid sm:grid-cols-12 sm:gap-2">
                <template
                    v-for="field in fields"
                    :key="field['name'] + '_' + (new Date()).getTime()"
                >
                    <SelectField v-if="field['type'] === 'select' || field['type'] === 'foreign'" v-bind="field" />
                    <InputField v-else v-bind="field" val="'asdasd'" />
                </template>
            </div>

        </div>
    </AppLayout>
</template>
