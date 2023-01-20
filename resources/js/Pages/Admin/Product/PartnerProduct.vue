<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import Datatable from '@/Components/Admin/Datatable.vue';
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
            <Datatable :pagination-links="products.links">
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
                        <tr v-for="product,i in products.data" :key="product.id" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ product.nama_partner }}</td>
                            <td class="table-td">{{ product.nama_bisnis }}</td>
                            <td class="table-td">{{ product.name }}</td>
                            <td class="table-td">{{ product.nama_kategori }}</td>
                            <td class="table-td">{{ product.bpom }}</td>
                            <td class="table-td">{{ product.description }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('admin.partner.product.show', product.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
