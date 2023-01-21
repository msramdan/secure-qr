<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import Datatable from '@/Components/Admin/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    products: Object,
    filters: Object
});
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.partner.product.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.partner.product.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Produk"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Produk</h2>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="products.per_page == 10">10</option>
                        <option :value="25" :selected="products.per_page == 25">25</option>
                        <option :value="50" :selected="products.per_page == 50">50</option>
                        <option :value="100" :selected="products.per_page == 100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text" v-model="search" class="form-input-dashboard" placeholder="Search">
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
            </div>
            <Pagination :data="products"/>
        </div>
    </AdminLayout>
</template>
