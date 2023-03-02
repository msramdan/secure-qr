<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    product: Object
})
</script>

<template>
    <Head title="Detail Product"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Produk</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Production Code</td>
                            <td class="table-td-detail">{{ product.production_code }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Name</td>
                            <td class="table-td-detail">{{ product.name }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Slug</td>
                            <td class="table-td-detail">{{ product.slug }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Category</td>
                            <td class="table-td-detail">{{ product.category.name }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Business Partner</td>
                            <td class="table-td-detail">{{ product.business.name }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">BPOM</td>
                            <td class="table-td-detail">{{ product.bpom }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Expired Date</td>
                            <td class="table-td-detail">{{ product.expired_date }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Netto</td>
                            <td class="table-td-detail">{{ product.netto }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Deskripsi</td>
                            <td class="table-td-detail">{{ product.description }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img :src="`/storage/uploads/photos/` + product.photo" alt="Logo" class="md:w-48 rounded">
                            </td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold">Created At</td>
                            <td class="table-td-detail">{{ product.created_at }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Updated At</td>
                            <td class="table-td-detail">{{ product.updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link :href="route('partner.produk.index')">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </PartnerLayout>
</template>
