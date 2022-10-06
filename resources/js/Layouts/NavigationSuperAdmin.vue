<script setup>
</script>

<template>
    <li>
        <a :href="route('dashboard.index')">
            <span>Início</span>
        </a>
    </li>
    <li>
        <a :href="route('user.index')">
            <span>Usuários</span>
        </a>
    </li>
    <li>
        <a :href="route('company.index')">
            <span>Empresa</span>
        </a>
    </li>
    <li>
        <a :href="route('department.index')">
            <span>Departamentos</span>
        </a>
    </li>
    <li>
        <a :href="route('product.index')">
            <span>Produtos</span>
        </a>
    </li>
    <li>
        <a :href="route('machinery.index')">
            <span>Estação de trabalho</span>
        </a>
    </li>
    <li>
        <a :href="route('part.index')">
            <span>Etapa de Produto</span>
        </a>
    </li>
    <li>
        <a :href="route('production_order.index')">
            <span>Ordem de Produção</span>
        </a>
    </li>
</template>
