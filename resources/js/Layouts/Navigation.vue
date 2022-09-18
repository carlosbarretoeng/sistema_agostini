<script setup>
import NavigationBase from './NavigationBase.vue';
import NavigationApps from './NavigationApps.vue';
const toggleDrawer = () => {
    document.getElementById("drawerApp").checked = false;
}
</script>

<template>
    <ul class="menu w-full bg-base-100">
        <div>
            <li class="sm:hidden">
                <a @click.prevent="toggleDrawer" class="h-16">
                    <font-awesome-icon icon="arrow-left"/>
                    <span>&nbsp;</span>
                </a>
            </li>
        </div>
        <NavigationBase />
        <NavigationApps />
        <li>
            <a :href="route('company.index')">
                <span>Empresa</span>
            </a>
        </li>
    </ul>
</template>
