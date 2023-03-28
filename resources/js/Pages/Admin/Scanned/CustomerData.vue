<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';
const props = defineProps({
    customers: Object,
    filters: Object,
    productOnlyNames: Array,
    productSelected: String
});
const filterChange = (event) => {
    Inertia.get(route('admin.customer.index'), {
        paginate: document.getElementById('paginate').value,
        product: document.getElementById('product').value
    })
}

const doExport = () => {

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    let product = params.product;

    window.location = '/panel/customer_data/export-excel?product=' + product;
}

let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.customer.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Customer"/>

    <AdminLayout>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Customer</h2>
                <ButtonCreate href="#"/>
                <button @click="() => {doExport()}" class="btn btn-primary">
                    <i class="zmdi zmdi-format-list-bulleted"></i>
                    Export Excel
                </button>
            </div>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0" style="gap: 20px;">
                    <div style="display: flex; align-items: center; gap: 5px">
                        <div>Show</div>
                        <select class="form-input-dashboard w-20" id="paginate" @change="filterChange($event)">
                            <option :value="10" :selected="customers.per_page == 10">10</option>
                            <option :value="25" :selected="customers.per_page == 25">25</option>
                            <option :value="50" :selected="customers.per_page == 50">50</option>
                            <option :value="100" :selected="customers.per_page == 100">100</option>
                        </select>
                        <div>entries</div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 5px">
                        <div style="white-space: nowrap;">Nama Produk</div>
                        <select class="form-input-dashboard w-50" id="product" @change="filterChange($event)">
                            <option :selected="productSelected == 'Semua Produk'">Semua Produk</option>
                            <option :value="productName.name" :selected="productSelected == productName.name" v-for="(productName) in productOnlyNames">{{ productName.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    
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
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Produk</th>
                            <th class="table-th">Total Scan</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data,i in customers.data" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 == 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ data.serial_number }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ data.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ data.total }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">
                                <TableAction :detail-href="route('admin.customer.show', data.id)">
                                    <Link :href="route('admin.customer.update', data.id)" method="post" as="button">
                                        <ActionIcon>
                                            <!-- If terkunci -->
                                            <path v-if="data.status == true" stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            <!-- If terbuka -->
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                        </ActionIcon>
                                    </Link>
                                </TableAction>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="customers"/>
        </div>
    </AdminLayout>
</template>
