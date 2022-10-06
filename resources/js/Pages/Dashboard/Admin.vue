<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import AuthUtil from '@/../util/auth.util';

const props = defineProps({
})
</script>

<template>
    <AppLayout title="Início">
        <li>
            <a :href="route('department.index')">
                <span>Departamentos</span>
            </a>
        </li>
    </AppLayout>
</template>
