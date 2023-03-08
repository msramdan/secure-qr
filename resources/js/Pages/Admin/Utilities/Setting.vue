<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
const props = defineProps({
    setting: Array
});
const form = useForm({
    id: props.setting.id,
    name: props.setting.nama_website,
    logo_dark: '',
    logo_light: '',
    telepon: props.setting.telpon,
    email: props.setting.email,
    alamat: props.setting.alamat,
    deskripsi: props.setting.deskripsi,
    status: props.setting.is_aktif,
});
const SubmitForm = () => {
    Inertia.post(route('admin.setting.update', form.id), {
        _method: 'patch',
        nama_website: form.name,
        telpon: form.telepon,
        email: form.email,
        deskripsi: form.deskripsi,
        is_aktif: form.status,
        logo_dark: form.logo_dark,
        logo_light: form.logo_light,
    })
}
</script>

<template>
    <Head title="Setting Website"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <h2 class="font-bold text-lg mb-5">Setting Website</h2>
            <form class="form-dashboard" @submit.prevent="SubmitForm">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Nama Website :</label>
                            <input type="text" v-model="form.name" class="form-input-dashboard" placeholder="Nama website">
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Logo Dark :</label>
                            <img :src="`/storage/img/` + props.setting.logo_dark" alt="Logo" class="w-1/2 mb-2">
                            <label for="logo_dark" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">{{ form.logo_dark != '' ? form.logo_dark.name : 'Choose file ' }}</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="logo_dark"  @input="form.logo_dark = $event.target.files[0]" class="hidden">
                            <InputError :message="form.errors.logo_dark" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Logo Light :</label>
                            <img :src="`/storage/img/` + props.setting.logo_light" alt="Logo" class="w-1/2 mb-2">
                            <label for="logo_light" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">{{ form.logo_light != '' ? form.logo_light.name : 'Choose file' }}</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="logo_light"  @input="form.logo_light = $event.target.files[0]" class="hidden">
                            <InputError :message="form.errors.logo_light" />
                        </div>
                        <div class="mb-5">
                            <label for="telepon" class="form-label-dashboard">Telepon :</label>
                            <input type="text" v-model="form.telepon" id="telepon" class="form-input-dashboard" placeholder="Telepon">
                            <InputError :message="form.errors.telepon" />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="form-label-dashboard">Email :</label>
                            <input type="text" v-model="form.email" id="email" class="form-input-dashboard" placeholder="Email">
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="mb-5">
                            <label for="alamat" class="form-label-dashboard">Alamat :</label>
                            <textarea v-model="form.alamat" id="alamat" rows="3" class="form-input-dashboard" placeholder="Alamat"></textarea>
                            <InputError :message="form.errors.alamat" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="deskripsi" class="form-label-dashboard">Deskripsi :</label>
                            <textarea v-model="form.deskripsi" id="deskripsi" rows="5" class="form-input-dashboard" placeholder="Deskripsi"></textarea>
                            <InputError :message="form.errors.deskripsi" />
                        </div>
                        <div>
                            <label for="status" class="form-label-dashboard">Apakah Website Aktif :</label>
                            <select v-model="form.status" id="status" class="form-input-dashboard">
                                <option value="1" :selected="form.status == false">Aktif</option>
                                <option value="0" :selected="form.status == true">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="form-btn-dashboard">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
