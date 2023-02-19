<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import debounce from 'lodash/debounce';
const props = defineProps({
    category: Object,
    filters: Object
});
const getPaginate = (event) => {
    let selectedOption = event.target.value;
    Inertia.get(route('admin.category.index'), {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(route('admin.category.index'), { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <Head title="Data Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Kategori</h2>
                <ButtonCreate :href="route('admin.category.create')"/>
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
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Kode</th>
                            <th class="table-th">Nama</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="kategori,i in category.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ kategori.code }}</td>
                            <td class="table-td">{{ kategori.name }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('admin.category.show', kategori.id)" :edit-href="route('admin.category.edit',kategori.id)" :delete-href="route('admin.category.destroy', kategori.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <Pagination :data="category"/>
        </div>
    </AdminLayout>
</template>
