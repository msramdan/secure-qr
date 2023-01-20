<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Admin/Datatable.vue';
const props = defineProps({
    category: Array
});
</script>

<template>
    <Head title="Data Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Kategori</h2>
                <ButtonCreate :href="route('admin.category.create')"/>
            </div>
            <Datatable :pagination-links="category.links">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Kode</th>
                            <th class="table-th">Nama</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="kategori,i in category.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ kategori.code }}</td>
                            <td class="table-td">{{ kategori.name }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('admin.category.show', kategori.id)" :edit-href="route('admin.category.edit',kategori.id)" :delete-href="route('admin.category.destroy', kategori.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
