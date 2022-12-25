<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Tambah Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Kategori</h2>
            <form class="form-dashboard" action="#">
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Kode :</label>
                    <input type="text" name="" class="form-input-dashboard" placeholder="123456">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Nama :</label>
                    <input type="text" name="" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <FormButton href="#" text="Simpan"/>
            </form>
        </div>
    </AdminLayout>
</template>
