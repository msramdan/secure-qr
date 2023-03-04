<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
const form = useForm({
    name:''
});
const FormSubmit = () => {
    form.post(route('admin.category.store'))
}
</script>

<template>
    <Head title="Tambah Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Kategori</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
                <div class="mb-5">
                    <label for="nama" class="form-label-dashboard">Nama :</label>
                    <input type="text" v-model="form.name" id="nama" class="form-input-dashboard" placeholder="John Doe">
                    <InputError :message="form.errors.name"/>
                </div>
                <FormButton :href="route('admin.category.index')" text="Simpan"/>
            </form>
        </div>
    </AdminLayout>
</template>
