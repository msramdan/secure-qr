<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    products: Array
});
</script>

<template>
    <Head title="Data Produk"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Produk</h2>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text" class="form-input-dashboard" placeholder="Search">
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Partner</th>
                            <th class="table-th">Bisnis</th>
                            <th class="table-th">Nama Produk</th>
                            <th class="table-th">Kategori</th>
                            <th class="table-th">BPOM</th>
                            <th class="table-th">Deskripsi</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product,i in products.data" :key="product.id">
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.nama_partner }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.nama_bisnis }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.nama_kategori }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.bpom }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">{{ product.description }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': product.id % 2 != 0 }">
                                <TableAction :detailHref="route('admin.partner.product.show', product.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="products"/>
        </div>
    </AdminLayout>
</template>
