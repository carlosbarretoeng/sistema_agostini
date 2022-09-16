<script setup>
import _ from 'lodash';
import NavigationSuperAdmin from './NavigationSuperAdmin.vue';
import AuthUtil from './../../util/auth.util';

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
        <NavigationSuperAdmin v-if="AuthUtil.testaPerfil($page.props.user, 'super-admin')" />
        <div>
            <li v-if="AuthUtil.testaPermissao($page.props.user, 'empresa.view')">
                <a :href="route('empresa.index')">
                    <span>Empresas</span>
                </a>
            </li>
            <li v-if="AuthUtil.testaPermissao($page.props.user, 'departamento.view')">
                <a :href="route('departamento.index')">
                    <span>Departamentos</span>
                </a>
            </li>
            <li v-if="AuthUtil.testaPermissao($page.props.user, 'maquinario.view')">
                <a :href="route('maquinario.index')">
                    <span>Maquinário</span>
                </a>
            </li>
            <li v-if="AuthUtil.testaPermissao($page.props.user, 'peca.view')">
                <a :href="route('peca.index')">
                    <span>Peça</span>
                </a>
            </li>
        </div>
    </ul>
</template>
