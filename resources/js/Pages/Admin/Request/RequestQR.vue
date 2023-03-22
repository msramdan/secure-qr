<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';
const props = defineProps({
    requests: Object,
    filters: Object,
})
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.request.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.request.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Request QR"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Request QR</h2>
                <ButtonCreate :href="route('admin.request.create')"/>
            </div>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="requests.per_page == 10">10</option>
                        <option :value="25" :selected="requests.per_page == 25">25</option>
                        <option :value="50" :selected="requests.per_page == 50">50</option>
                        <option :value="100" :selected="requests.per_page == 100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text"  v-model="search" class="form-input-dashboard" placeholder="Search">
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Kode</th>
                            <th class="table-th">Produk</th>
                            <th class="table-th">Type QR</th>
                            <th class="table-th">Qty</th>
                            <th class="table-th">Total Harga</th>
                            <th class="table-th">Status</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="request, i in requests.data" :key="request.id">
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.product_name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.type_qrcode }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.qty }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.amount_price }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.status }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">
                                <TableAction :detailHref="route('admin.request.show', request.id)">
                                    <Link v-if="request.status == 'Waiting Payment'" :href="route('admin.request.edit', request.id)">
                                        <div class="bg-[#DDDAF2] hover:bg-opacity-75 flex items-center justify-center w-8 h-8 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-purple-1100 w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </div>
                                    </Link>

                                    <Link :href="route('admin.request.destroy', request.id)" as="button" method="delete">
                                        <div class="bg-[#DDDAF2] hover:bg-opacity-75 flex items-center justify-center w-8 h-8 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-purple-1100 w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </div>
                                    </Link>
                                </TableAction>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="requests" />
        </div>
    </AdminLayout>
</template>