<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputText from '@/Components/InputText.vue';
import InputSelect from "@/Components/InputSelect.vue";
import AuthUtil from '@/../util/auth.util'
import TextUtil from '@/../util/text.util'
import TimeUtil from "@/../util/time.util";

const props = defineProps({
    context: String,
    id: Number,
    company_id: Number | null,
    name: String,
    productRecipe: Array,
    companies: Array,
    machineries: Array,
    parts: Array,
})

const isCreateContext = props.context === 'create'
const isShowContext = props.context === 'show'
const isEditContext = props.context === 'edit'

const form = useForm({
    id: props.id ?? null,
    company_id: props.company_id ?? null,
    name: props.name ?? null
})

const formRecipe = useForm({
    product_id: props.id ?? null,
    part_id: null,
    machinery_id: null,
    order: props.productRecipe.length + 1,
    quantity: null,
})

const destroyProduct = () => {
    Inertia.delete(route('product.destroy', props.id));
}

const saveNewProduct = () => {
    Inertia.post(route('product.store'), form);
}

const updateProduct = () => {
    Inertia.put(route('product.update', props.id), form);
}

const sumPartsTimes = () => {
    const value = props.productRecipe.reduce((older, newer) => older + (newer.quantity * newer.partAverageProductionTime), 0)
    return value > 0 ? TimeUtil.secondsToTimestamp(value) : '-'
}

const updateOrderDelete = (productRecipeItem) => {
    Inertia.delete(route('product_recipe.destroy', productRecipeItem.id), useForm({
        product_id: productRecipeItem.productId,
    }));
}

const updateOrderUp = (productRecipeItem) => {
    Inertia.put(route('product_recipe.update', productRecipeItem.id), useForm({
        id: productRecipeItem.id,
        product_id: productRecipeItem.productId,
        order: productRecipeItem.order + 1
    }));
}

const updateOrderDown = (productRecipeItem) => {
    Inertia.put(route('product_recipe.update', productRecipeItem.id), useForm({
        id: productRecipeItem.id,
        product_id: productRecipeItem.productId,
        order: productRecipeItem.order - 1
    }));
}

const addProductRecipeItem = () => {
    Inertia.post(route('product_recipe.store'), formRecipe);
}

</script>

<template>
    <AppLayout>
        <template #header>
            <template v-if="isCreateContext">
                Novo Produto
            </template>
            <template v-if="isShowContext || isEditContext">
                Produto
            </template>
        </template>
        <template #actions>
            <a :href="route('product.index')" class="btn btn-outline mr-2 gap-2">
                <font-awesome-icon icon="fa-solid fa-arrow-left" size="lg" />
                <span class="hidden sm:inline-block">Voltar</span>
            </a>
            <template v-if="isCreateContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'product.create'})" @click="saveNewProduct()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-save" size="lg" />
                    <span class="hidden sm:inline-block">Salvar</span>
                </a>
            </template>
            <template v-if="isEditContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'product.update'})" @click="updateProduct()" class="btn btn-success gap-2">
                    <font-awesome-icon icon="fa-solid fa-arrows-rotate" size="lg" />
                    <span class="hidden sm:inline-block">Atualizar</span>
                </a>
            </template>
            <template v-if="isShowContext">
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'product.update'})" :href="route('product.edit', id)" class="btn btn-info mr-2 gap-2">
                    <font-awesome-icon icon="fa-solid fa-edit" size="lg" />
                    <span class="hidden sm:inline-block">Editar</span>
                </a>
                <a v-if="AuthUtil.canView($page.props.user, {permission: 'product.delete'})" href="#deleteModal" class="btn btn-error gap-2">
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
            <InputSelect label="Empresa" :options="companies" v-model="form.company_id" :disabled="isShowContext" />
            <InputText label="Nome" v-model="form.name" :disabled="isShowContext" />
        </div>

        <div class="divider">Etapa de Produto</div>

        <div v-if="isEditContext" class="grid sm:grid-cols-4 gap-2 mb-2">
            <a href="#addProductModal" class="btn w-full sm:col-span-4 gap-2">
                <font-awesome-icon icon="fa-solid fa-add" size="lg" />
                <span class="hidden sm:inline-block">Adicionar Produto</span>
            </a>
            <div class="modal" id="addProductModal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Adicionar Etapa de Produto</h3>
                    <div>
                        <InputSelect label="Etapa" :options="parts"  v-model="formRecipe.part_id"/>
                        <InputSelect label="Estação de trabalho" :options="machineries" v-model="formRecipe.machinery_id" />
                        <InputText label="Quantidade" mask="##" v-model="formRecipe.quantity"/>
                    </div>
                    <div class="modal-action">
                        <a href="#" class="btn">Cancelar</a>
                        <a class="btn" href="#" @click="addProductRecipeItem()">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-3 gap-2">
            <template v-for="(productRecipeItem, index) in productRecipe" :key="index">
                <div class="card card-compact bg-base-100 shadow-sm">
                    <div class="flex items-center space-x-2 h-12 p-2 bg-base-300">
                        <div class="avatar placeholder">
                            <div class="bg-neutral-focus text-neutral-content rounded-full w-6">
                                <span>{{ productRecipeItem['order'] }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{ productRecipeItem['quantity'] }}x {{ productRecipeItem['partName'] }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-2">
                        <div class="w-full">
                            <div class="grid grid-cols-2 font-light border-b-2">
                                <div class="font-semibold">Estação:</div>
                                <div class="text-right">{{ productRecipeItem['machineryName'] ?? '---' }}</div>
                            </div>
                            <div class="grid grid-cols-2 font-light">
                                <div class="font-semibold">Tempo Médio:</div>
                                <div class="text-right">{{ productRecipeItem['partAverageProductionTime'] ?? '---' }}</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="isEditContext" class="bg-base-300/25 grid grid-cols-3 gap-2 p-2">
                        <button class="btn btn-ghost btn-sm w-full gap-2" @click="updateOrderUp(productRecipeItem)" :disabled="productRecipeItem['order'] === productRecipe.length">
                            <font-awesome-icon icon="fa-solid fa-up-long"/>
                        </button>
                        <button class="btn btn-ghost btn-sm w-full gap-2" @click="updateOrderDelete(productRecipeItem)">
                            <font-awesome-icon icon="fa-solid fa-trash"/>
                        </button>
                        <button class="btn btn-ghost btn-sm w-full gap-2" @click="updateOrderDown(productRecipeItem)" :disabled="productRecipeItem['order'] <= 1">
                            <font-awesome-icon icon="fa-solid fa-down-long"/>
                        </button>
                    </div>
                </div>
            </template>
        </div>

<!--        <div class="overflow-x-auto">-->
<!--            <div class="w-full max-w-md">-->
<!--                <table class="table w-full">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th v-if="isEditContext" class="bg-base-300"></th>-->
<!--                        <th class="text-center bg-base-300">Ordem</th>-->
<!--                        <th class="bg-base-300">Etapa de Produto</th>-->
<!--                        <th class="text-center bg-base-300">Estação de Trabalho</th>-->
<!--                        <th class="text-right bg-base-300">Quantidade</th>-->
<!--                        <th class="text-right bg-base-300">Tempo Médio</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr v-for="(productRecipeItem, index) in productRecipe" :key="index">-->
<!--                        <td v-if="isEditContext">-->
<!--                            <div class="btn-group">-->
<!--                                <button class="btn btn-outline btn-square btn-xs" @click="updateOrderDelete(productRecipeItem)">-->
<!--                                    <font-awesome-icon icon="fas fa-trash" />-->
<!--                                </button>-->
<!--                                <button class="btn btn-outline btn-square btn-xs" @click="updateOrderDown(productRecipeItem)" :disabled="productRecipeItem['order'] <= 1">-->
<!--                                    <font-awesome-icon icon="fa-solid fa-up-long" />-->
<!--                                </button>-->
<!--                                <button class="btn btn-outline btn-square btn-xs" @click="updateOrderUp(productRecipeItem)" :disabled="productRecipeItem['order'] === productRecipe.length">-->
<!--                                    <font-awesome-icon icon="fas fa-down-long" />-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">{{ productRecipeItem['order'] }}</td>-->
<!--                        <td><a :href="route('part.show',productRecipeItem['partId'])">{{ productRecipeItem['partName'] }}</a></td>-->
<!--                        <td v-if="productRecipeItem['machineryName']" class="text-center"><a :href="route('machinery.show',productRecipeItem['machineryId'])">{{ productRecipeItem['machineryName'] }}</a></td>-->
<!--                        <td v-else class="text-center">-</td>-->
<!--                        <td class="text-right">{{ productRecipeItem['quantity'] }}</td>-->
<!--                        <td class="text-right">{{ TimeUtil.secondsToTimestamp(productRecipeItem['quantity'] * productRecipeItem['partAverageProductionTime']) }}</td>-->
<!--                    </tr>-->
<!--                    <tr v-if="isEditContext">-->
<!--                        <td>-->
<!--                            <div class="btn-group w-full">-->
<!--                                <button class="btn btn-outline btn-square btn-xs" @click="addProductRecipeItem()">-->
<!--                                    <font-awesome-icon icon="fas fa-add" />-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="form-control w-full">-->
<!--                                <input-->
<!--                                    type="text"-->
<!--                                    :value="formRecipe.order"-->
<!--                                    class="input input-bordered w-full disabled:border-base-300 disabled:border-1"-->
<!--                                    disabled-->
<!--                                />-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <div class="form-control w-full">-->
<!--                                <select-->
<!--                                    class="select select-bordered w-full disabled:border-base-300 disabled:border-1"-->
<!--                                    :value="formRecipe.part_id"-->
<!--                                    @input="event => formRecipe.part_id = event.target.value"-->
<!--                                >-->
<!--                                    <option v-for="(option) in parts" :key="option.id" :value="option.id">{{ option.name }}</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <div class="form-control w-full">-->
<!--                                <select-->
<!--                                    class="select select-bordered w-full disabled:border-base-300 disabled:border-1"-->
<!--                                    :value="formRecipe.machinery_id"-->
<!--                                    @input="event => formRecipe.machinery_id = event.target.value"-->
<!--                                >-->
<!--                                    <option>-</option>-->
<!--                                    <option v-for="(option) in machineries" :key="option.id" :value="option.id">{{ option.name }}</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <div class="form-control w-full">-->
<!--                                <input-->
<!--                                    type="number"-->
<!--                                    min="1"-->
<!--                                    :value="formRecipe.quantity"-->
<!--                                    @input="event => formRecipe.quantity = event.target.value"-->
<!--                                    class="input input-bordered w-full disabled:border-base-300 disabled:border-1"-->
<!--                                />-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td>-</td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                    <tfoot>-->
<!--                    <tr>-->
<!--                        <th v-if="isEditContext" class="bg-base-300"></th>-->
<!--                        <th class="text-right bg-base-300" colspan="4">Tempo Total Médio</th>-->
<!--                        <th class="text-right bg-base-300">{{ sumPartsTimes() }}</th>-->
<!--                    </tr>-->
<!--                    </tfoot>-->
<!--                </table>-->
<!--                <span class="text-xs">* <b>T.M.P.</b> - Tempo médio de produção em minutos</span>-->
<!--            </div>-->
<!--        </div>-->
    </AppLayout>
</template>