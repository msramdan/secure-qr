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
                <ButtonCreate :href="route('partner.produk.create')" />
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
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.production_code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.bisnis }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.category }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.bpom }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">
                                <TableAction :detail-href="route('partner.produk.show', product.id)" :edit-href="route('partner.produk.edit', product.id)" :delete-href="route('partner.produk.destroy', product.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
