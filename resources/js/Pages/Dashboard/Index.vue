<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SuperAdminDashboard from "./SuperAdminDashboard.vue";
import AuthUtil from '@/../util/auth.util';

const props = defineProps({
    stats: Array
})
</script>

<template>
    <AppLayout title="Início">
        <SuperAdminDashboard :stats="stats" v-if="AuthUtil.canView($page.props.user, {role: 'super-admin'})"/>
    </AppLayout>
</template>
