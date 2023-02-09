<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';
import { Inertia } from '@inertiajs/inertia';
const props = defineProps({
    contacts: Object,
    filters: Object
});
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.contact.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.contact.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Kontak"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Kontak</h2>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="contacts.per_page == 10">10</option>
                        <option :value="25" :selected="contacts.per_page == 25">25</option>
                        <option :value="50" :selected="contacts.per_page == 50">50</option>
                        <option :value="100" :selected="contacts.per_page == 100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text" class="form-input-dashboard" v-model="search" placeholder="Search">
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Nama Lengkap</th>
                            <th class="table-th">Email</th>
                            <th class="table-th">Telepon</th>
                            <th class="table-th">Perusahaan</th>
                            <th class="table-th">Industri</th>
                            <th class="table-th">Informasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact,i in contacts.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ contact.nama }}</td>
                            <td class="table-td">{{ contact.email }}</td>
                            <td class="table-td">{{ contact.telepon }}</td>
                            <td class="table-td">{{ contact.perusahaan }}</td>
                            <td class="table-td">{{ contact.industri }}</td>
                            <td class="table-td">{{ contact.informasi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="contacts"/>
        </div>
    </AdminLayout>
</template>
