<script setup>
import VueQrcode from '@chenfengyuan/vue-qrcode';

const props = defineProps({
    id: Number,
    company: Object,
    progress: Number,
    status: String
})
</script>

<template>
    <div class="overflow-x-auto bg-white w-[21cm]">
        <div class="flex gap-2">
            <div class="flex-none">
                <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 100 }"></vue-qrcode>
            </div>
            <div class="flex-1">
                <div class="text-center text-[30px] font-bold">{{ company.name }}</div>
                <div class="text-center text-[20px] font-bold">Ordem de Produção Monitorada - #{{ id }}</div>
                <div class="text-center text-[16px] font-semibold">Início em 31/12/2022 - Término em 31/12/2022</div>
            </div>
            <div class="flex-none">
                <vue-qrcode :value="'company.' + company.id + '.production_order.' + id" :options="{ width: 100 }"></vue-qrcode>
            </div>
        </div>
        <div class="divider">Produtos</div>
        <div class="p-2">
            <table class="table table-compact w-full">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Favorite Color</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->
                <tr>
                    <th>
                        1
                    </th>
                    <td>Cy Ganderton</td>
                    <td>Quality Control Specialist</td>
                    <td>Blue</td>
                </tr>
                <!-- row 2 -->
                <tr>
                    <th>2</th>
                    <td>Hart Hagerty</td>
                    <td>Desktop Support Technician</td>
                    <td>Purple</td>
                </tr>
                <!-- row 3 -->
                <tr>
                    <th>3</th>
                    <td>Brice Swyre</td>
                    <td>Tax Accountant</td>
                    <td>Red</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="divider">Etapas de Produção</div>
        <div class="p-2">
            <table class="table table-compact w-full">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Job</th>
                    <th>Favorite Color</th>
                </tr>
                </thead>
                <tbody>
                <!-- row 1 -->
                <tr>
                    <th>
                        1
                    </th>
                    <td>Cy Ganderton</td>
                    <td>Quality Control Specialist</td>
                    <td>Blue</td>
                </tr>
                <!-- row 2 -->
                <tr>
                    <th>2</th>
                    <td>Hart Hagerty</td>
                    <td>Desktop Support Technician</td>
                    <td>Purple</td>
                </tr>
                <!-- row 3 -->
                <tr>
                    <th>3</th>
                    <td>Brice Swyre</td>
                    <td>Tax Accountant</td>
                    <td>Red</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
