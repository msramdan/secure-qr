<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Data Customer"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Data Customer</h2>
            <table class="table">
                <tbody>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Serial Number</td>
                        <td class="table-td-detail">CKTNF</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Nama Produk</td>
                        <td class="table-td-detail">Night Cream Acne 10gr</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Customer Data</td>
                        <td class="table-td-detail"></td>
                    </tr>
                </tbody>
            </table>
            <Link href="#">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
