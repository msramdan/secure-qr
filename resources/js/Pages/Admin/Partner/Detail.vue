<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Partner</h2>
            <div class="flex flex-col lg:flex-row lg:space-x-8">
                <div class="flex-1">
                    <table class="w-full">
                        <tbody>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Nama</td>
                                <td class="border-b p-3">John Doe</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Email</td>
                                <td class="border-b p-3">johndoe@gmail.com</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Phone</td>
                                <td class="border-b p-3">08xxxxxxxxxx</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Pic</td>
                                <td class="border-b p-3">John Doe Pic</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Address</td>
                                <td class="border-b p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, esse deleniti! Animi et eaque eos ipsum odit non, aperiam unde officiis praesentium, impedit itaque perferendis quod delectus omnis autem quia?</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Created at</td>
                                <td class="border-b p-3">31 Desember 2022</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Updated at</td>
                                <td class="border-b p-3">1 Januari 2023</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex-1">
                    <div class="p-3">
                        <div class="font-semibold mb-2">Photo</div>
                        <img src="https://labelin.co/storage/uploads/photos/5hPS2CzpgGXS8csvvyYaoxNML3wexSJhQrjDi2OB.png" alt="Logo" class="w-32 rounded mb-2">
                    </div>
                    <div class="p-3">
                        <div class="font-semibold mb-2">Video</div>
                        <video class="w-full rounded mb-2" controls>
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link href="#">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
