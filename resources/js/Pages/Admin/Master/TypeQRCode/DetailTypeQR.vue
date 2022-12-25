<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Type QR"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Type QR</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Nama</td>
                        <td class="table-td-detail table-td-dark">Label thermal (3x1,5cm) Portrait</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Harga</td>
                        <td class="table-td-detail">350</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Photo</td>
                        <td class="table-td-detail table-td-dark">
                            <img src="https://labelin.co/storage/uploads/photos/9d3oGAl6v50WahFABmB11c6uLKycMrtOg3KMs7yx.jpg" alt="Type QR" class="md:w-64">
                        </td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Created at</td>
                        <td class="table-td-detail">2 Januari 2023</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Updated at</td>
                        <td class="table-td-detail table-td-dark">4 Januari 2023</td>
                    </tr>
                </tbody>
            </table>
            <Link href="#">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
