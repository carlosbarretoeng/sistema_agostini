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
                <!-- <font-awesome-icon icon="home"/> -->
                <span>Início</span>
            </a>
        </li>
        <li>
            <a :href="route('empresa.index')">
                <!-- <font-awesome-icon icon="fa-solid fa-buildings" /> -->
                <span>Empresas</span>
            </a>
        </li>
        <li>
            <a :href="route('departamento.index')">
                <!-- <font-awesome-icon icon="fa-solid fa-building" /> -->
                <span>Departamentos</span>
            </a>
        </li>
    </ul>
</template>
