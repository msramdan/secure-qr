<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Edit User"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit User</h2>
            <form class="form-dashboard" action="#">
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Nama :</label>
                    <input type="text" name="" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Email :</label>
                    <input type="email" name="" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Password :</label>
                    <input type="password" name="" class="form-input-dashboard" placeholder="********">
                    <InputError message="Kosongkan jika tidak ingin merubah password" />
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Konfirmasi Password :</label>
                    <input type="password" name="" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Role :</label>
                    <select name="" id="" class="form-input-dashboard">
                        <option value="">Choose</option>
                        <option value="">Super Admin</option>
                        <option value="">Admin Toko</option>
                    </select>
                </div>
                <FormButton href="#" text="Update"/>
            </form>
        </div>
    </AdminLayout>
</template>
