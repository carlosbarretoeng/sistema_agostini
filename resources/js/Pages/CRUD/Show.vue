<script setup>
import { mask } from 'maska'
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import AppLayout from '@/Layouts/AppLayout.vue';
import Fields from "./components/Fields.vue";

const props = defineProps({
    label: {
        type: String
    },
    entity: {
        type: String
    },
    fields: {
        type: Array
    },
    data: {
        type: Object
    },
    disabled: {
        type: Boolean,
        default: true
    }
})

const preForm = {};

props.fields.forEach(field => {
    preForm[field['name']] = ''
})

const form = useForm(preForm);

const updateFormValue = (event, formField) => {
    form[formField] = event;
}

const formatarValorPorMascara = (mascara, valor) => {
    return mask(valor, mascara) ?? valor;
}

const calculateClass = (field) => {
    let returnObj = {};
    returnObj['col-span-' + field['colSpan']] = true;
    return returnObj;
}

function submit() {
    Inertia.post(route(props.entity + '.store'), form);
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
                    <a :href="route(entity + '.edit', data['id'])" class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-edit"/>
                        <span class="hidden sm:block">Editar</span>
                    </a>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto mb-4">
            <div class="grid sm:grid-cols-12 sm:gap-2">
                <Fields
                    v-for="field in fields"
                    :key="field['name'] + '_' + (new Date()).getTime()"
                    v-bind="{field, 'value': '' + data[field['name']], disabled}"
                    @update="updateFormValue($event, field['name'])"
                />
            </div>
        </div>

        <div class="overflow-x-auto mb-4">
            <slot></slot>
        </div>

    </AppLayout>
</template>
