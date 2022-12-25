<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Data Bisnis Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Bisnis Partner</h2>
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Name</th>
                            <th class="table-th">Brand</th>
                            <th class="table-th">Manufacture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in 10" :key="n">
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': n % 2 != 0 }">Row {{ n }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
