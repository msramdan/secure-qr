<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    products: Object
})
</script>

<template>
    <Head title="Detail Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Produk</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="table-td-detail font-semibold table-td-dark md:truncate">Nama Partner</td>
                            <td class="table-td-detail table-td-dark">{{ products.nama_partner }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Bisnis</td>
                            <td class="table-td-detail">{{ products.nama_bisnis }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold table-td-dark md:truncate">Nama Produk</td>
                            <td class="table-td-detail table-td-dark">{{ products.name }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Slug</td>
                            <td class="table-td-detail">{{products.slug}}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold table-td-dark md:truncate">Kategori</td>
                            <td class="table-td-detail table-td-dark">{{products.nama_kategori}}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">BPOM</td>
                            <td class="table-td-detail">{{products.bpom}}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold table-td-dark md:truncate">Deskripsi</td>
                            <td class="table-td-detail table-td-dark">{{products.description}}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img :src="`/storage/uploads/photos/` + products.photo" :alt="products.photo" class="w-32 rounded">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link :href="route('admin.partner.product.index')">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </AdminLayout>
</template>
