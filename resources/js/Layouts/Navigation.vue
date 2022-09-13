<script setup>
import _ from 'lodash';
import {usePage} from "@inertiajs/inertia-vue3";

const findPermission = (permission) => {
    return _.union(usePage().props.value.user.roles.map(el => {
        return el.permissions.map(ell => ell.name);
    }))[0].indexOf(permission) > -1;
}

const findRole = (role) => {
    return _.union(usePage().props.value.user.roles.map(el => {
        return el.name;
    })).indexOf(role) > -1;
}

const toggleDrawer = () => {
    document.getElementById("drawerApp").checked = false;
}
</script>

<template>
    <ul class="menu w-full bg-base-100">
        <div>
            <li class="sm:hidden">
                <a @click.prevent="toggleDrawer">
                    <font-awesome-icon icon="arrow-left"/>
                    <span>&nbsp;</span>
                </a>
            </li>
            <li>
                <a :href="route('dashboard')">
                    <span>Início</span>
                </a>
            </li>
            <hr/>
        </div>
        <div v-if="findRole('super-admin')">
            <li>
                <a :href="route('usuario.index')">
                    <span>Usuários</span>
                </a>
            </li>
            <hr/>
        </div>
        <li>
            <a :href="route('empresa.index')">
                <span>Empresas</span>
            </a>
        </li>
        <li>
            <a :href="route('departamento.index')">
                <span>Departamentos</span>
            </a>
        </li>
        <li>
            <a :href="route('maquinario.index')">
                <span>Maquinário</span>
            </a>
        </li>
    </ul>
</template>
