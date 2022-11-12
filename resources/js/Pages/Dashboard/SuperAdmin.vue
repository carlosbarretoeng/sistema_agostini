<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    users_number: Number,
    company_number: Number,
    department_number: Number,
    product_number: Number,
    machinery_number: Number,
    production_order_number: Number,
})
</script>

<template>
    <AppLayout title="Início">
        <div class="grid sm:grid-cols-6 gap-2">
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Usuários</div>
                    <div class="stat-value">{{ users_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Empresas</div>
                    <div class="stat-value">{{ company_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Departamentos</div>
                    <div class="stat-value">{{ department_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Produtos</div>
                    <div class="stat-value">{{ product_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Estações de Trabalho</div>
                    <div class="stat-value">{{ machinery_number }}</div>
                </div>
            </div>
            <div class="stats shadow">
                <div class="stat">
                    <div class="stat-title">Ordens de Produção</div>
                    <div class="stat-value">{{ production_order_number }}</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
