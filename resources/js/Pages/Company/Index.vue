<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextUtil from '@/../util/text.util'

const props = defineProps({
    companies: Array
})

</script>

<template>
    <AppLayout>
        <template #header>
            Empresas
        </template>
        <template #actions>
            <a :href="route('company.create')" class="btn btn-primary gap-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" size="lg" />
                <span class="hidden sm:inline-block">Adicionar</span>
            </a>
        </template>
        <div class="grid sm:grid-cols-4 gap-2">
            <template v-for="company in companies" :key="company.id">
                <a :href="route('company.show', company.id)" class="card w-full bg-base-100 shadow-xl p-2">
                    <div class="flex items-center space-x-3">
                        <div class="avatar placeholder">
                            <div class="bg-neutral-focus text-neutral-content rounded-full w-12">
                                <span>{{ TextUtil.initials(company.name) }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="font-bold">{{ company.name }}</div>
                        </div>
                    </div>
                </a>
            </template>
        </div>
    </AppLayout>
</template>
