<script setup>
import AuthUtil from "@/../util/auth.util";

const toggleDrawer = () => {
    document.getElementById("drawerApp").checked = false;
}
</script>

<template>
    <ul class="menu w-full bg-base-100">
        <li>
            <a :href="route('dashboard.index')">
                <span>Início</span>
            </a>
        </li>
        <li v-if="AuthUtil.canView($page.props.user, { role: 'super-admin' })">
            <a :href="route('user.index')">
                <span>Usuários</span>
            </a>
        </li>
        <li v-if="AuthUtil.canView($page.props.user, { role: 'super-admin' })">
            <a :href="route('company.index')">
                <span>Empresa</span>
            </a>
        </li>
        <li class="menu-title bg-base-200">
            <span>Tempos</span>
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
        <li class="menu-title bg-base-200">
            <span>Custos</span>
        </li>
        <li>
            <a :href="route('plano_de_contas.index')">
                <span>Planos de Contas</span>
            </a>
        </li>
    </ul>
</template>
