<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    productScanned: Object,
    serial_number: String,
    product: Object
})
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
                        <td class="table-td-detail">{{ serial_number }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Nama Produk</td>
                        <td class="table-td-detail">{{ product.name + "-" + product.netto }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Customer Data</td>
                        <td class="table-td-detail">
                            <ul class="list-disc">
                                <li v-for="data,i in productScanned" :key="i">{{ data.kota }}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('admin.customer.index')">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
