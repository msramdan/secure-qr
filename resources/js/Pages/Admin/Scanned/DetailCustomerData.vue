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
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Serial Number</td>
                        <td class="table-td-detail table-td-dark">CKTNF</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Nama Produk</td>
                        <td class="table-td-detail">Night Cream Acne 10gr</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Alamat</td>
                        <td class="table-td-detail table-td-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos, qui.</td>
                    </tr>
                </tbody>
            </table>
            <Link href="#">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
