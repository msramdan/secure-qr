<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    partner: Object
})
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
                                <td class="border-b p-3">{{ partner.name }}</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Email</td>
                                <td class="border-b p-3">{{ partner.email }}</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Phone</td>
                                <td class="border-b p-3">{{ partner.phone }}</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Pic</td>
                                <td class="border-b p-3">{{ partner.pic }}</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Address</td>
                                <td class="border-b p-3">{{ partner.address }}</td>
                            </tr>
                            <tr>
                                <td class="border-b p-3 w-32 font-semibold">Created at</td>
                                <td class="border-b p-3">{{ partner.created_at }}</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="border-b p-3 w-32 font-semibold">Updated at</td>
                                <td class="border-b p-3">{{ partner.updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex-1">
                    <div class="p-3">
                        <div class="font-semibold mb-2">Photo</div>
                        <img :src="`/storage/uploads/profiles/` + partner.photo" :alt="partner.photo" class="w-32 rounded mb-2">
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link :href="route('admin.partner.index')">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
