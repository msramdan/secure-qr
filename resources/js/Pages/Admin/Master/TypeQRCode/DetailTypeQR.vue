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
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Nama</td>
                        <td class="table-td-detail table-td-dark">{{ type.name }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Harga</td>
                        <td class="table-td-detail">{{ type.price }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Photo</td>
                        <td class="table-td-detail table-td-dark">
                            <img v-if="type.photo == null || type.photo == 'qrcode.jpg'" src="https://labelin.co/storage/uploads/photos/9d3oGAl6v50WahFABmB11c6uLKycMrtOg3KMs7yx.jpg" alt="Type QR" class="md:w-64">
                            <img v-else :src="`/storage/uploads/type_qr/` + type.photo" alt="Type QR" class="md:w-64">
                        </td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Created at</td>
                        <td class="table-td-detail">{{ type.created_at }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold table-td-dark">Updated at</td>
                        <td class="table-td-detail table-td-dark">{{ type.updated_at }}</td>
                    </tr>
                </tbody>
            </table>
            <Link :href="route('admin.type.index')">
                <button class="btn-cancel">Kembali</button>
            </Link>
        </div>
    </AdminLayout>
</template>
