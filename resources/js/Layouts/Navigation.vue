<script setup>
const toggleDrawer = () => {
    document.getElementById("drawerApp").checked = false;
}
</script>

<template>
    <ul class="menu w-full bg-base-100">
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
        <li>
            <a :href="route('app.tempos.index')">
                <span>App Tempos</span>
            </a>
        </li>
        <hr/>
        <li>
            <a :href="route('usuario.index')">
                <span>Usuários</span>
            </a>
        </li>
        <li>
            <a :href="route('perfil.index')">
                <span>Perfis</span>
            </a>
        </li>
        <li>
            <a :href="route('permissao.index')">
                <span>Permissões</span>
            </a>
        </li>
        <hr/>
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
