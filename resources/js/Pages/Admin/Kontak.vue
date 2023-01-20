<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Admin/Datatable.vue';

const props = defineProps({
    contacts: Array
});
</script>

<template>
    <Head title="Data Kontak"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Kontak</h2>
            <Datatable :pagination-links="contacts.links">
                <table class="table">
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
                        <tr v-for="contact,i in contacts.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ contact.nama_lengkap }}</td>
                            <td class="table-td">{{ contact.email }}</td>
                            <td class="table-td">{{ contact.subjek }}</td>
                            <td class="table-td">{{ contact.deskripsi }}</td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
