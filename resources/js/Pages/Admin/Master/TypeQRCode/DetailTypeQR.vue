<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const props = defineProps({
    type: Array
});
console.log(props.type);
</script>

<template>
    <Head title="Detail Type QR"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Type QR</h2>
            <table class="table">
                <tbody>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Nama</td>
                        <td class="table-td-detail">{{ type.name }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Harga</td>
                        <td class="table-td-detail">{{ type.price }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Photo</td>
                        <td class="table-td-detail">
                            <img v-if="type.photo == null || type.photo == 'qrcode.jpg'" src="https://labelin.co/storage/uploads/photos/9d3oGAl6v50WahFABmB11c6uLKycMrtOg3KMs7yx.jpg" alt="Type QR" class="sm:w-64">
                            <img v-else :src="`/storage/uploads/type_qr/` + type.photo" alt="Type QR" class="sm:w-64">
                        </td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Created at</td>
                        <td class="table-td-detail">{{ type.created_at }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Updated at</td>
                        <td class="table-td-detail">{{ type.updated_at }}</td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('admin.type.index')">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
