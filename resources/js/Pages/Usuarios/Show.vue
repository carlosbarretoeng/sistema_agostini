<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputField from '@/Pages/CRUD/components/InputField.vue';

const props = defineProps({
    data: Object,
    permissions: Array
})

const permissionsMaped = props.permissions.map(el => [el.name, el.description]).reduce((oldVal, curVal) => {
    let curValSplited = curVal[0].split('.');
    if(Object.keys(oldVal).indexOf(curValSplited[0]) === -1) {
        oldVal[curValSplited[0]] = []
    }
    oldVal[curValSplited[0]].push([curVal[0], curVal[1]]);
    return oldVal;
}, {});

const checaSeTemPermissao = (permissao) => {
    console.log(props.data.syncPermissions.filter(el => el.name === permissao));
    return props.data.syncPermissions.filter(el => el.name === permissao).length > 0;
}

</script>

<template>
    <AppLayout>
        <template #header>
            <div class="flex gap-2">
                <div class="flex-1 font-semibold text-xl text-gray-800 pt-3">
                    Usuário
                </div>
                <div class="flex-none">
                    <a :href="route('usuario.index')" class="btn btn-outline gap-2">
                        <font-awesome-icon icon="fa-solid fa-arrow-left"/>
                        <span class="hidden sm:block">Voltar</span>
                    </a>
                </div>
                <div class="flex-none">
                    <a  class="btn btn-primary gap-2">
                        <font-awesome-icon icon="fa-solid fa-edit"/>
                        <span class="hidden sm:block">Editar</span>
                    </a>
                </div>
                <div class="flex-none">
                    <a :href="route('usuario.index')" class="btn btn-secondary gap-2">
                        <i class="fa-solid fa-unlock"></i>
                        <span class="hidden sm:block">Recuperar senha</span>
                    </a>
                </div>
            </div>
        </template>

        <div class="overflow-x-auto mb-4">
            <div class="grid sm:grid-cols-12 sm:gap-2 mb-2">
                <InputField
                    label="Nome"
                    :colSpan="3"
                    :mask="null"
                    :value="data['name']"
                    disabled
                />
                <InputField
                    label="Email"
                    :colSpan="3"
                    :mask="null"
                    :value="data['email']"
                    disabled
                />
            </div>
            <div class="divider"></div>
            <h5 class="font-medium">Restrições de Acesso</h5>
            <div class="grid sm:grid-cols-12 sm:gap-2 mb-2">
                <InputField
                    label="Empresa"
                    :colSpan="3"
                    :mask="null"
                    :value="data['empresas'] ? data['empresas'].nome_fantasia : ''"
                    disabled
                />
                <InputField
                    label="Perfil"
                    :colSpan="3"
                    :mask="null"
                    :value="data['roles'] ? data['roles'][0].description : ''"
                    disabled
                />
            </div>
            <div class="grid sm:grid-cols-12 sm:gap-2 mb-2">
                <div v-for="(value, key, index) in permissionsMaped" :key="index" class="sm:col-span-2 mb-2">
                    <div class="w-full border-2 border-base-300">
                        <div class="p-2">
                            <h5 class="font-medium">{{ key }}</h5>
                            <div v-for="(val, idx) in value" :key="index + '_' + idx" class="form-control">
                                <label class="label cursor-pointer">
                                    <span class="label-text">{{ val[1] }}</span>
                                    <input type="checkbox" :value="val[0]" :checked="checaSeTemPermissao(val[0])" class="checkbox" disabled />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
