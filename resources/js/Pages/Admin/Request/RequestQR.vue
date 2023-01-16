<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
const props = defineProps({
    requests: Array
})
onMounted(() => {  })
const form = useForm({
    paginate: ''
});
const getPaginate = () => {
    form.get(route('admin.request.index'))
}
</script>

<template>
    <Head title="Data Request QR"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Request QR</h2>
                <ButtonCreate href="#"/>
            </div>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" v-model="form.paginate" @change="getPaginate">
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
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.type_qrcode.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.qty }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.amount_price }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">{{ request.status }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': request.id % 2 != 0 }">
                                <TableAction v-if="request.status == 'Waiting Payment'" editHref="#" deleteHref="#"/>
                                <TableAction v-else :detailHref="route('admin.request.show', request.id)" deleteHref="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="requests" />
        </div>
    </AdminLayout>
</template>