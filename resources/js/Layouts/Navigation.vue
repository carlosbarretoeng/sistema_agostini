<script setup>
import AuthUtil from "@/../util/auth.util";
import NavigationSuperAdmin from "./NavigationSuperAdmin.vue";
import NavigationAdmin from './NavigationAdmin.vue';
import NavigationColaborator from './NavigationColaborator.vue';

const toggleDrawer = () => {
    document.getElementById("drawerApp").checked = false;
}
</script>

<template>
    <ul class="menu w-full bg-base-100">
        <NavigationSuperAdmin v-if="AuthUtil.canView($page.props.user, {role: 'super-admin'})"/>
        <NavigationAdmin v-if="AuthUtil.canView($page.props.user, {role: 'admin'})"/>
        <NavigationColaborator v-if="AuthUtil.canView($page.props.user, {role: 'colaborator'})"/>
    </ul>
</template>
