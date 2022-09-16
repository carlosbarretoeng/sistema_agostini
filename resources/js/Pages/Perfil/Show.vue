<script setup>
import { mask } from 'maska'
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import AppLayout from '@/Layouts/AppLayout.vue';
import Fields from "@/Pages/CRUD/components/Fields.vue";

const props = defineProps({
    perfil: Object,
    permissoes: Array
})

const perfilMapeado = props.perfil.permissions.map(el => el.name);

const grupoDePermissoes = props.permissoes?.reduce((older, newer) => {
    const permissaoNome = newer.name.split('.');
    const permissaoDescricao = newer.description;

    if(Object.keys(older).indexOf(permissaoNome[0]) === -1) older[permissaoNome[0]] = [];

    older[permissaoNome[0]].push([newer.name, permissaoDescricao])
    return older;
}, {}) ?? [];

const form = useForm({
    name: props.perfil.name ?? null,
    description: props.perfil.description ?? null,
    guard: 'web'
});

function submit() {
    Inertia.post(route('perfil.store'), form);
}
</script>
<template>
    <AppLayout>
        <template #header>
            <div class="flex gap-2">
                <div class="flex-1 font-semibold text-xl text-gray-800 pt-3">
                    Perfil
                </div>
                <div class="flex-none">
                    <a :href="route('perfil.index')" class="btn btn-outline gap-2">
                        <font-awesome-icon icon="fa-solid fa-arrow-left"/>
                        <span class="hidden sm:block">Voltar</span>
                    </a>
                </div>
                <div class="flex-none">
                    <button @click="submit" class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-save"/>
                        <span class="hidden sm:block">Salvar</span>
                    </button>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto">
            <div class="grid sm:grid-cols-12 sm:gap-2">
                <Fields :field="{label: 'Descrição', type:'string', colSpan: 3}" :value="form.description" disabled/>
            </div>

            <div class="grid sm:mt-2 sm:grid-cols-12 sm:gap-2">
                <div class="col-span-2 border-2 border-primary mx-1 mb-2 sm:m-0" v-for="(value, key, index) in grupoDePermissoes" :key="index">
                    <div class="p-2 font-medium">{{ key }}</div>
                    <div v-for="(val, idx) in value" :key="idx" class="form-control">
                        <label class="label cursor-pointer">
                            <input type="checkbox" :value="val[0]" :checked="perfilMapeado.indexOf(val[0]) > -1" class="checkbox"  disabled/>
                            <div class="w-full pl-2">{{ val[1] }}</div> 
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
