<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
const props = defineProps({
    type: Array
});
</script>

<template>
    <Head title="Data Type QR"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Type QR</h2>
                <ButtonCreate :href="route('admin.type.create')"/>
            </div>
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
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Nama</th>
                            <th class="table-th">Harga</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tipe,i in type.data" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': tipe.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': tipe.id % 2 != 0 }">{{ tipe.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': tipe.id % 2 != 0 }">{{ tipe.price }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': tipe.id % 2 != 0 }">
                                <TableAction :detailHref="route('admin.type.show',tipe.id)" :editHref="route('admin.type.edit',tipe.id)" :deleteHref="route('admin.type.destroy',tipe.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="type"/>
        </div>
    </AdminLayout>
</template>
