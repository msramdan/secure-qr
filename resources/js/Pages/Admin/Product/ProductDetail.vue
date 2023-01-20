<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Produk</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Nama Partner</td>
                            <td class="table-td-detail">Demo User</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Bisnis</td>
                            <td class="table-td-detail">Demo Company</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Nama Produk</td>
                            <td class="table-td-detail">Tonner</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Slug</td>
                            <td class="table-td-detail">tonner</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Kategori</td>
                            <td class="table-td-detail">Dokumen</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">BPOM</td>
                            <td class="table-td-detail">77125689304</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Deskripsi</td>
                            <td class="table-td-detail">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis tempora laboriosam dicta eos eum minima temporibus quidem eaque quo esse mollitia numquam aut laborum, cupiditate et, corrupti nemo earum. Nihil.</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img src="https://labelin.co/storage/uploads/photos/FvXAw5pP8H0Ias6IrBlEcZC4xMufssymI0BqykuC.jpg" alt="Photo" class="sm:w-40 rounded">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link href="#">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
