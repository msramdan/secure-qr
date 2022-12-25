<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

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
                        <td class="table-td-detail table-td-dark">12345678</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Nama</td>
                        <td class="table-td-detail">Bahan Makanan</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Created at</td>
                        <td class="table-td-detail table-td-dark">2 Januari 2023</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Updated at</td>
                        <td class="table-td-detail">4 Januari 2023</td>
                    </tr>
                </tbody>
            </table>
            <Link href="#">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
