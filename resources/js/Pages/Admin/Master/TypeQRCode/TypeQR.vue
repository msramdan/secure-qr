<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';
const props = defineProps({
    type: Array,
    filters: Object
});
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.type.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.type.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Type QR"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Type QR</h2>
                <ButtonCreate :href="route('admin.type.create')"/>
            </div>
            <div class="flex flex-wrap items-center md:justify-between mb-5">
                <div class="flex items-center space-x-2 mb-2 md:mb-0">
                    <div>Show</div>
                    <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="type.per_page == 10">10</option>
                        <option :value="25" :selected="type.per_page == 25">25</option>
                        <option :value="50" :selected="type.per_page == 50">50</option>
                        <option :value="100" :selected="type.per_page == 100">100</option>
                    </select>
                    <div>entries</div>
                </div>
                <div class="w-full md:w-auto">
                    <input type="text" v-model="search" class="form-input-dashboard" placeholder="Search">
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Nama</th>
                            <th class="table-th">Harga</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tipe,i in type.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ tipe.name }}</td>
                            <td class="table-td">{{ tipe.price }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('admin.type.show',tipe.code)" :edit-href="route('admin.type.edit',tipe.code)" :delete-href="route('admin.type.destroy',tipe.code)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="type"/>
        </div>
    </AdminLayout>
</template>
