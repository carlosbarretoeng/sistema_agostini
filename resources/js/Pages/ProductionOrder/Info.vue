<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from '@/Components/InputText.vue';
import InputSelect from "@/Components/InputSelect.vue";
import AuthUtil from '@/../util/auth.util';
import NumberUtil from '@/../util/number.util';
import TimeUtil from "@/../util/time.util";

const props = defineProps({
    context: String,
    id: Number,
    company_id: Number | null,
    date_start: String,
    date_finish: String,
    status: String,
    production_order_products: Array,
    production_order_parts: Array,
    production_order_actions: Array,
    companies: Array,
    products: Array,
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const statusOptions = [
    {id: 'draft', name: 'Rascunho'},
    {id: 'waiting', name: 'Pronto para Produção'},
    {id: 'in_production', name: 'Em Produção'},
    {id: 'done', name: 'Finalizado'},
    {id: 'canceled', name: 'Cancelado'}
];

const form = useForm({
    id: props.id ?? null,
    company_id: props.company_id ?? null,
    date_start: TimeUtil.YYYYMMDDtoDDMMYYYY(props.date_start) ?? null,
    date_finish: TimeUtil.YYYYMMDDtoDDMMYYYY(props.date_finish) ?? null,
    status: props.status ?? 'draft',
})

const formNewProduct = useForm({
    production_order_id: props.id,
    product_id: null,
    quantity: null,
})

const destroyProductionOrder = () => {
    Inertia.delete(route('production_order.destroy', props.id));
}

const saveNewProductionOrder = () => {
    Inertia.post(route('production_order.store'), form);
}

const updateProductionOrder = () => {
    Inertia.put(route('production_order.update', props.id), form);
}

const incrementProduct = (id) => {
    Inertia.put(route('production_order_product.increment', props.id), useForm({
        production_order_product: id
    }));
}
const decrementProduct = (id) => {
    Inertia.put(route('production_order_product.decrement', props.id), useForm({
        production_order_product: id
    }));
}
const addProduct = () => {
    Inertia.post(route('production_order_product.store'), formNewProduct);
    formNewProduct.reset();
}
const deleteProduct = (id) => {
    Inertia.delete(route('production_order_product.destroy', id));
}

const consoleLog = (data) => {
    console.log(data)
}
</script>

<template>
    <AppLayout>
        <template #header>
            <template v-if="isCreateContext">
                Nova Ordem de Produção
            </template>
            <template v-if="isShowContext || isEditContext">
                Ordem de Produção
            </template>
        </template>
        <template #actions>
            <a :href="route('production_order.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.create'})" @click="saveNewProductionOrder()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="isEditContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.update'})" @click="updateProductionOrder()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
            </template>
            <template v-if="isShowContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.read'})" :href="route('production_order.print', id)" target="_blank" class="btn btn-accent mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-print" size="lg" />
                    <span class="hidden sm:inline-block">Imprimir</span>
                </a>
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.update'})" :href="route('production_order.edit', id)" class="btn btn-info mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-edit" size="lg" />
                    <span class="hidden sm:inline-block">Editar</span>
                </a>
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'production_order.delete'})" href="#deleteModal" class="btn btn-error gap-2">
                    <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                    <span class="hidden sm:inline-block">Excluir</span>
                </a>
                <div class="modal" id="deleteModal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Excluir Empresa</h3>
                        <p class="py-4">Tem certeza de que quer excluir essa empresa? Essa operação não poderá ser defeita.</p>
                        <div class="modal-action">
                            <a @click="destroyProduct()" class="btn">Sim</a>
                            <a href="#" class="btn">Não</a>
                        </div>
                    </div>
                </div>
            </template>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <InputSelect label="Empresa" :options="companies" v-model="form.company_id" :disabled="isShowContext"/>
            <InputText label="Data de Início" v-model="form.date_start" :disabled="isShowContext" mask="##/##/####"/>
            <InputText label="Data de Término" v-model="form.date_finish" :disabled="isShowContext" mask="##/##/####"/>
            <InputSelect label="Status" :options="statusOptions" v-model="form.status" :disabled="isShowContext || isCreateContext"/>
        </div>
        <div class="divider">Produtos</div>
        <div class="">
            <table class="table table-compact w-full">
                <thead>
                <tr>
                    <th v-if="isEditContext" class="w-1 text-center bg-base-300">&nbsp;</th>
                    <th class="bg-base-300">Produto</th>
                    <th class="w-1/6 text-center bg-base-300">Quantidade</th>
                </tr>
                </thead>
                <tbody>
                <tr v-if="isEditContext">
                    <td colspan="3">
                        <a href="#addProductModal" class="btn w-full gap-2">
                            <font-awesome-icon icon="fa-solid fa-add" size="lg" />
                            <span class="hidden sm:inline-block">Adicionar Produto</span>
                        </a>
                        <div class="modal" id="addProductModal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Adicionar Produto</h3>
                                <div>
                                    <InputSelect label="Produto" :options="products" v-model="formNewProduct.product_id" />
                                    <InputText label="Quantidade" v-model="formNewProduct.quantity" mask="##"/>
                                </div>
                                <div class="modal-action">
                                    <a href="#" class="btn">Cancelar</a>
                                    <a class="btn" @click="addProduct()">Adicionar</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-for="(production_order_product, index) in production_order_products" :key="index">
                    <td v-if="isEditContext">
                        <a class="btn btn-sm btn-ghost btn-square" @click="deleteProduct(production_order_product.id)">
                            <font-awesome-icon icon="fa-solid fa-trash" size="lg" />
                        </a>
                    </td>
                    <td>{{ production_order_product.product.name }}</td>
                    <td class="text-center">
                        <template v-if="isEditContext">
                            <div class="form-control">
                                <label class="input-group w-full justify-center">
                                    <button @click="decrementProduct(production_order_product.id)" class="btn btn-sm btn-ghost" :disabled="production_order_product.quantity <= 1">
                                        <font-awesome-icon icon="fa-solid fa-minus" />
                                    </button>
                                    <span>{{ production_order_product.quantity }}</span>
                                    <button @click="incrementProduct(production_order_product.id)" class="btn btn-sm btn-ghost">
                                        <font-awesome-icon icon="fa-solid fa-plus" />
                                    </button>
                                </label>
                            </div>


                        </template>
                        <template v-else>
                            {{ production_order_product.quantity }}
                        </template>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-if="production_order_parts.length" class="divider">Etapas de Produção</div>
        <div class="grid sm:grid-cols-3 gap-2">
            <template v-for="(production_order_part, index) in production_order_parts" :key="index">
                <div class="card card-compact bg-base-100 shadow-xl mb-2">
                    <div class="flex items-center px-2">
                        <div class="text-xs font-bold">{{ production_order_part.product_recipe?.product.name }}</div>
                    </div>
                    <div class="flex px-2 border-b-2">
                        <div class="font-bold">{{ production_order_part.quantity }}x {{ production_order_part.product_recipe?.part.name }}</div>
                    </div>
                    <div class="flex items-center space-x-2 px-2">
                        <div class="w-full">
                            <div class="grid grid-cols-3 font-light">
                                <div class="col-span-3 sm:col-span-2 font-semibold">Quantidade já produzida:</div>
                                <div class="col-span-3 sm:col-span-1 sm:text-right pl-4 sm:pl-0">{{ production_order_part.done ?? 0  }} de {{ production_order_part.quantity }}</div>
                            </div>
                            <div class="grid grid-cols-3 font-light">
                                <div class="col-span-3 sm:col-span-2 font-semibold">Estação de Trabalho:</div>
                                <div class="col-span-3 sm:col-span-1 sm:text-right pl-4 sm:pl-0">{{ production_order_part.product_recipe.part.machinery.name ?? '---' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div v-if="production_order_actions.length" class="divider">Registros</div>
        <div v-if="production_order_actions.length" class="w-full">
            <div v-for="(production_order_action, index) in production_order_actions" :key="index" class="card card-compact mb-2 w-full bg-base-100 shadow-xl sm:hidden">
                <div class="card-body">
                    <div class="font-bold">{{ TimeUtil.toFormatedString(production_order_action.created_at) }} - {{ production_order_action.user.name }}</div>
                    <div class="font-semibold">{{ production_order_action.action.description }}</div>
                    <div class="text-xs">{{ production_order_action.description }}</div>
                </div>
            </div>
            <div  class="grid grid-cols-3 gap-2 bg-base-300 rounded-t-md">
                <div class="p-2 font-bold">Data & Responsável</div>
                <div class="p-2 font-bold">Evento</div>
                <div class="p-2 font-bold">Descrição</div>
            </div>
            <template v-for="(production_order_action, index) in production_order_actions" :key="index">
                <div  class="grid grid-cols-3 gap-2  bg-base-100  rounded-b-md">
                    <div class="p-2">{{ TimeUtil.toFormatedString(production_order_action.created_at) }} - {{ production_order_action.user.name }}</div>
                    <div class="p-2">{{ production_order_action.action.description }}</div>
                    <div class="p-2">{{ production_order_action.description }}</div>
                </div>
            </template>
        </div>
    </AppLayout>
</template>
