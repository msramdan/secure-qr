<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Partner"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Bisnis</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Code</td>
                            <td class="table-td-detail">1116</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Name</td>
                            <td class="table-td-detail">azarinecosmetic.com</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Brand</td>
                            <td class="table-td-detail">azarine</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Manufacture</td>
                            <td class="table-td-detail">Sidoarjo</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img src="https://labelin.co/storage/uploads/logos/PXlXpsyHPHSa1AlEAU3TZm3bEsk19nX6KZAIQk7a.png" alt="Logo" class="md:w-48 rounded">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold md:truncate">Created At</td>
                            <td class="table-td-detail">15 Desember 2022</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Updated At</td>
                            <td class="table-td-detail">23 Desember 2022</td>
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
