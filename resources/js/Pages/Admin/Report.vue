<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Admin/Datatable.vue';
const props = defineProps({
    reports: Array
});
</script>

<template>
    <Head title="Data Report"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Report</h2>
            <Datatable :pagination-links="reports.links">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Lengkap</th>
                            <th class="table-th">Nomor Telepon</th>
                            <th class="table-th">Kronologi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="report,i in reports.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ report.qr_codes.serial_number }}</td>
                            <td class="table-td">{{ report.fullname }}</td>
                            <td class="table-td">{{ report.phone_number }}</td>
                            <td class="table-td">{{ report.kronologi }}</td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
