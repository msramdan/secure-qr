<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import Datatable from '@/Components/Admin/Datatable.vue';

import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    customers: Array
});
</script>

<template>
    <Head title="Data Customer"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Customer</h2>
            <Datatable :pagination-links="customers.links">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Produk</th>
                            <th class="table-th">Waktu Scan</th>
                            <th class="table-th">Total Scan</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">{{ i}}</td>
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">
                                <TableAction detailHref="#">
                                    <Link href="#">
                                        <ActionIcon>
                                            <!-- If terkunci -->
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            <!-- If terbuka -->
                                            <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /> -->
                                        </ActionIcon>
                                    </Link>
                                </TableAction>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
