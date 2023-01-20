<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import Datatable from '@/Components/Admin/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    requests: Array
})
console.log(props.requests.links);
</script>

<template>
    <Head title="Data Request QR"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Request QR</h2>
                <ButtonCreate href="#"/>
            </div>
            <Datatable :pagination-links="requests.links">
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
                        <tr v-for="request, index in requests.data">
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ ++index }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.type_qrcode.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.qty }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.amount_price }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.status }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">
                                <TableAction v-if="request.status == 'Waiting Payment'" editHref="#"/>
                                <TableAction v-else detailHref="#" deleteHref="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
