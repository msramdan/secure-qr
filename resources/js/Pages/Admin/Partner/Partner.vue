<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Data Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Partner</h2>
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
                            <th class="table-th">Nama</th>
                            <th class="table-th">Email</th>
                            <th class="table-th">Telepon</th>
                            <th class="table-th">Gambar</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in 10" :key="n">
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">
                                <TableAction detailHref="#" editHref="#" deleteHref="#">
                                    <Link href="#">
                                        <ActionIcon>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                                        </ActionIcon>
                                    </Link>
                                </TableAction>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-wrap items-center justify-between mt-5">
                <div class="text-gray-500 mb-2 md:mb-0">Showing 1 to 10 of 32 entries</div>
                <div class="flex divide-x divide-purple-1100 border border-purple-1100 rounded">
                    <button class="text-gray-500 px-3.5 py-1.5">Previous</button>
                    <div class="bg-purple-1100 text-white w-10 text-center py-1.5">1</div>
                    <div class="w-10 text-center py-1.5">2</div>
                    <div class="w-10 text-center py-1.5">3</div>
                    <button class="px-3.5 py-1.5">Next</button>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
