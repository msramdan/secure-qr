<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    category: Array
});
</script>

<template>
    <Head title="Detail Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Kategori</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Kode</td>
                        <td class="table-td-detail table-td-dark">{{ category.code }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Nama</td>
                        <td class="table-td-detail">{{ category.name }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Created at</td>
                        <td class="table-td-detail table-td-dark">{{ category.created_at }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Updated at</td>
                        <td class="table-td-detail">{{ category.updated_at }}</td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('admin.category.index')">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
