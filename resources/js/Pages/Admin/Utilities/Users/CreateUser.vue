<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    roles: Object
})
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: ''
})
const FormSubmit = () => {
    form.post(route('admin.users.store'))
}
</script>

<template>
    <Head title="Tambah User"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah User</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Name :</label>
                    <input type="text" v-model="form.name" id="name" class="form-input-dashboard" placeholder="John Doe">
                    <InputError :message="form.errors.name" />
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label-dashboard">Email :</label>
                    <input type="email" v-model="form.email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                    <InputError :message="form.errors.email" />
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label-dashboard">Password :</label>
                    <input type="password" v-model="form.password" id="password" class="form-input-dashboard" placeholder="********">
                    <InputError :message="form.errors.password" />
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="form-label-dashboard">Konfirmasi Password :</label>
                    <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-input-dashboard" placeholder="********">
                    <InputErrorVue :message="form.errors.password_confirmation" />
                </div>
                <div class="mb-5">
                    <label for="role" class="form-label-dashboard">Role :</label>
                    <select v-model="form.role"  id="role" class="form-input-dashboard">
                        <option value="" disabled>Choose Role</option>
                        <option :value="role.id" v-for="role,i in roles" :key="i">{{ role.name }}</option>
                    </select>
                    <InputError :message="form.errors.role" />
                </div>
                <FormButton :href="route('admin.users.index')" text="Simpan"/>
            </form>
        </div>
    </AdminLayout>
</template>
