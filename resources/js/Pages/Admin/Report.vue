<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';
const props = defineProps({
    reports: Array,
    filters: Object
});
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.report.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.report.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Report"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Report</h2>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="reports.per_page == 10">10</option>
                        <option :value="25" :selected="reports.per_page == 25">25</option>
                        <option :value="50" :selected="reports.per_page == 50">50</option>
                        <option :value="100" :selected="reports.per_page == 100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text" v-model="search" class="form-input-dashboard" placeholder="Search">
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Lengkap</th>
                            <th class="table-th">Nomor Telepon</th>
                            <th class="table-th">Kronologi</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="report,i in reports.data" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">{{ report.qr_codes.serial_number }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">{{ report.fullname }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">{{ report.phone_number }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">{{ report.kronologi }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': report.id % 2 != 0 }">
                                <TableAction detailHref="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="reports"/>
        </div>
    </AdminLayout>
</template>
