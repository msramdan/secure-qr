<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    products: Object,
    filters: Object
})
</script>

<template>
    <Head title="Data Produk"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Produk</h2>
                <div class="flex justify-between space-x-4">
                    <ButtonCreate :href="route('partner.produk.create')" />
                    <Link :href="route('partner.rating.index')">
                        <button class="bg-indigo-50 hover:bg-indigo-100 text-indigo-500 px-4 py-2 rounded-lg font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-0.5 text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"  d="M287.9 0C297.1 0 305.5 5.25 309.5 13.52L378.1 154.8L531.4 177.5C540.4 178.8 547.8 185.1 550.7 193.7C553.5 202.4 551.2 211.9 544.8 218.2L433.6 328.4L459.9 483.9C461.4 492.9 457.7 502.1 450.2 507.4C442.8 512.7 432.1 513.4 424.9 509.1L287.9 435.9L150.1 509.1C142.9 513.4 133.1 512.7 125.6 507.4C118.2 502.1 114.5 492.9 115.1 483.9L142.2 328.4L31.11 218.2C24.65 211.9 22.36 202.4 25.2 193.7C28.03 185.1 35.5 178.8 44.49 177.5L197.7 154.8L266.3 13.52C270.4 5.249 278.7 0 287.9 0L287.9 0zM287.9 78.95L235.4 187.2C231.9 194.3 225.1 199.3 217.3 200.5L98.98 217.9L184.9 303C190.4 308.5 192.9 316.4 191.6 324.1L171.4 443.7L276.6 387.5C283.7 383.7 292.2 383.7 299.2 387.5L404.4 443.7L384.2 324.1C382.9 316.4 385.5 308.5 391 303L476.9 217.9L358.6 200.5C350.7 199.3 343.9 194.3 340.5 187.2L287.9 78.95z"/>
                            </svg>
                            <span>Rating Product</span>
                        </button>
                    </Link>
                </div>
            </div>

            <Datatable  :paginationLinks="products" :filters="filters">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Production Code</th>
                            <th class="table-th">Product Name</th>
                            <th class="table-th">Business</th>
                            <th class="table-th">Category</th>
                            <th class="table-th">BPOM</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product,i in products.data" :key="i" class="odd:bg-odd">
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.production_code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.bisnis }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.category }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.bpom }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">
                                <TableAction :detail-href="route('partner.produk.show', product.code)" :edit-href="route('partner.produk.edit', product.code)" :delete-href="route('partner.produk.destroy', product.code)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
