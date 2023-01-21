<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Product"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Product</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Code</td>
                            <td class="table-td-detail">1101</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Name</td>
                            <td class="table-td-detail">Whitening Day Cream</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Slug</td>
                            <td class="table-td-detail">whitening-day-cream</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Category</td>
                            <td class="table-td-detail">Kosmetik</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Business Partner</td>
                            <td class="table-td-detail">msglowid.com</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">BPOM</td>
                            <td class="table-td-detail">NA18190123141</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Deskripsi</td>
                            <td class="table-td-detail">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis tempora laboriosam dicta eos eum minima temporibus quidem eaque quo esse mollitia numquam aut laborum, cupiditate et, corrupti nemo earum. Nihil.</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img src="https://labelin.co/storage/uploads/photos/gGXhyONauVNb8NmtsKj67QnyQ5G63echfDATgYzG.png" alt="Logo" class="md:w-48 rounded">
                            </td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold">Created At</td>
                            <td class="table-td-detail">6 Desember 2022</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Updated At</td>
                            <td class="table-td-detail">21 Desember 2022</td>
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
    </PartnerLayout>
</template>
