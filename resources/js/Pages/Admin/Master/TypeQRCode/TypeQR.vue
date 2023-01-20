<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Admin/Datatable.vue';
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
            <Datatable :pagination-links="type.links">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Nama</th>
                            <th class="table-th">Harga</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tipe,i in type.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ tipe.name }}</td>
                            <td class="table-td">{{ tipe.price }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('admin.type.show',tipe.id)" :edit-href="route('admin.type.edit',tipe.id)" :delete-href="route('admin.type.destroy',tipe.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
