<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
const props = defineProps({
    contacts: Array
});
</script>

<template>
    <Head title="Data Kontak"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Kontak</h2>
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
                            <th class="table-th">Nama Lengkap</th>
                            <th class="table-th">Email</th>
                            <th class="table-th">Subjek</th>
                            <th class="table-th">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact,i in contacts.data" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': contact.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': contact.id % 2 != 0 }">{{ contact.nama_lengkap }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': contact.id % 2 != 0 }">{{ contact.email }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': contact.id % 2 != 0 }">{{ contact.subjek }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': contact.id % 2 != 0 }">{{ contact.deskripsi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :links="contacts.links"/>
        </div>
    </AdminLayout>
</template>
