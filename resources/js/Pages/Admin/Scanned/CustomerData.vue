<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    customers: Array
});
</script>

<template>
    <Head title="Data Customer"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Customer</h2>
                <ButtonCreate href="#"/>
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
                        <tr v-for="i in 10" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ i}}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">
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
            </div>
            <Pagination :data="customers"/>
        </div>
    </AdminLayout>
</template>
