<template>
  <q-page>
    <q-toolbar inset class="bg-grey-3 text-grey-7 q-px-md">
      <span class="text-h4 text-weight-bold">
        Companies
      </span>
      <q-space />
      <q-btn flat round dense icon="fas fa-circle-plus" />
    </q-toolbar>
    <q-table
      :loading="loading"
      flat
      :rows="rows"
      :columns="columns"
      row-key="name"
      separator="cell"
    />
  </q-page>
</template>

<script lang="ts">
import { api } from './../boot/axios'
import { defineComponent, onMounted, ref } from 'vue';

export default defineComponent({
  name: 'IndexPage',
  setup () {
    const loading = ref(true)
    const columns = ref([
      { name: 'id', label: 'ID', field: 'id', align: 'left' },
      { name: 'name', label: 'Name', field: 'name', align: 'left' },
    ])
    const rows = ref([])

    onMounted(async () => {
      const model = await api.get('/companies')
      console.log(model);
      rows.value = model.data
      loading.value = false
    })
    return {
      loading,
      columns,
      rows
    };
  }
});
</script>
