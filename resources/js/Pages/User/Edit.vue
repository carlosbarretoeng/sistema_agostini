<script setup>
import CrudEdit from '@/Pages/CRUD/Edit.vue';

const props = defineProps({
    label: String,
    entity: String,
    fields: Array,
    data: Object,
    disabled: Boolean,
    permissoesDisponiveis: Array
})
</script>

<template>
    <CrudEdit
        :label="label"
        :entity="entity"
        :fields="fields"
        :data="data"
        :disabled="disabled"
    >
        <hr class="mt-4"/>
        <div class="flex-1 font-semibold pt-3">
            Permissões
        </div>
        <div class="grid grid-cols-12 gap-2">
            <div v-for="permissaoDisponivel in permissoesDisponiveis" :key="permissaoDisponivel['id']" class="form-control col-span-2">
                <label class="label cursor-pointer">
                    <span class="label-text">{{ permissaoDisponivel['name'] }}</span>
                    <input type="checkbox" class="toggle"/>
                </label>
            </div>
        </div>
    </CrudEdit>
</template>

