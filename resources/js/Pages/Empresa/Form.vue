<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    formEmpresa: {
        type: Object
    },
    readOnly: {
        type: Boolean,
        default: true
    }
})
</script>

<template>
    <div class="card w-full">
        <div class="px-4 grid sm:grid-cols-11 gap-4">
            <div class="form-control w-full sm:col-span-3">
                <label class="label">
                    <span class="label-text uppercase font-bold">CNPJ</span>
                </label>
                <div class="flex">
                    <input type="text" class="input input-bordered w-full" v-maska="'##.###.###/####-##'" v-model="formEmpresa.cnpj" :disabled="readOnly"/>
                    <!-- <button class="btn btn-square btn-accent ml-4" v-if="!disabled" @click="conculaReceitaWs">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button> -->
                </div>
            </div>
            <div class="form-control w-full sm:col-span-4">
                <label class="label">
                    <span class="label-text uppercase font-bold">Razão Social</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.razao_social" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full sm:col-span-4">
                <label class="label">
                    <span class="label-text uppercase font-bold">Nome Fantasia</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.nome_fantasia" :disabled="readOnly"/>
            </div>
        </div>
    </div>

    <div class="card w-full">
        <div class="px-4 grid sm:grid-cols-11 gap-4">
            <div class="form-control w-full sm:col-span-2">
                <label class="label">
                    <span class="label-text uppercase font-bold">CEP</span>
                </label>
                <div class="flex">
                    <input type="text" class="input input-bordered w-full" v-maska="'##.###-###'" v-model="formEmpresa.cep" :disabled="readOnly"/>
                    <!-- <button class="btn btn-square btn-accent ml-4" v-if="!disabled">
                        <i class="fa-solid fa-search fa-lg"></i>
                    </button> -->
                </div>
            </div>
            <div class="form-control w-full sm:col-span-6">
                <label class="label">
                    <span class="label-text uppercase font-bold">Logradouro</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.logradouro" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text uppercase font-bold">Número</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.numero" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full sm:col-span-2">
                <label class="label">
                    <span class="label-text uppercase font-bold">Complemento</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.complemento" :disabled="readOnly"/>
            </div>
        </div>
        <div class="px-4 grid sm:grid-cols-12 gap-4">
            <div class="form-control w-full sm:col-span-2">
                <label class="label">
                    <span class="label-text uppercase font-bold">Bairro</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.bairro" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full sm:col-span-2">
                <label class="label">
                    <span class="label-text uppercase font-bold">Cidade</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.cidade" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full sm:col-span-2">
                <label class="label">
                    <span class="label-text uppercase font-bold">UF</span>
                </label>
                <select class="select select-bordered w-full" v-model="formEmpresa.uf" :disabled="readOnly">
                    <option value="AC">AC - Acre</option>
                    <option value="AL">AL - Alagoas</option>
                    <option value="AM">AM - Amazonas</option>
                    <option value="AP">AP - Amapá</option>
                    <option value="BA">BA - Bahia</option>
                    <option value="CE">CE - Ceará</option>
                    <option value="DF">DF - Distrito Federal</option>
                    <option value="ES">ES - Espirito Santo</option>
                    <option value="GO">GO - Goiás</option>
                    <option value="MA">MA - Maranhão</option>
                    <option value="MG">MG - Minas Gerais</option>
                    <option value="MS">MS - Mato Grosso do Sul</option>
                    <option value="MT">MT - Mato Grosso</option>
                    <option value="PA">PA - Pará</option>
                    <option value="PB">PB - Paraíba</option>
                    <option value="PE">PE - Pernambuco</option>
                    <option value="PI">PI - Piaui</option>
                    <option value="PR">PR - Paraná</option>
                    <option value="RJ">RJ - Rio de Janeiro</option>
                    <option value="RN">RN - Rio Grande do Norte</option>
                    <option value="RO">RO - Rondônia</option>
                    <option value="RR">RR - Roraima</option>
                    <option value="RS">RS - Rio Grande do Sul</option>
                    <option value="SC">SC - Santa Catarina</option>
                    <option value="SE">SE - Sergipe</option>
                    <option value="SP">SP - São Paulo</option>
                    <option value="TO">TO - Tocantins</option>
                </select>
            </div>

            <div class="form-control w-full sm:col-span-3">
                <label class="label">
                    <span class="label-text uppercase font-bold">Email de contato</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-model="formEmpresa.email" :disabled="readOnly"/>
            </div>
            <div class="form-control w-full sm:col-span-3">
                <label class="label">
                    <span class="label-text uppercase font-bold">Telefone de contato</span>
                </label>
                <input type="text" class="input input-bordered w-full" v-maska="['+## ## ####-####', '+## (##) #####-####']" v-model="formEmpresa.telefone" :disabled="readOnly"/>
            </div>
        </div>
    </div>
</template>
