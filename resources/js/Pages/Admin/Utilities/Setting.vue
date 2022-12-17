<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Setting Website"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <h2 class="font-bold text-lg mb-5">Setting Website</h2>
            <form class="form-dashboard" action="#">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Nama Website :</label>
                            <input type="text" name="" class="form-input-dashboard form-input-error-dashboard" placeholder="Nama website">
                            <span class="form-error-message-dashboard">Ini adalah pesan error</span>
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Logo Dark :</label>
                            <img src="https://labelin.co/storage/img/setting_web/t9ebqSFalSmrWatWVjMNRomoFxa5KfJg9AYurwSE.png" alt="Logo" class="w-1/2 mb-2">
                            <label for="file" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">Choose file</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="file" class="hidden">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Logo Light :</label>
                            <img src="https://labelin.co/storage/img/setting_web/t9ebqSFalSmrWatWVjMNRomoFxa5KfJg9AYurwSE.png" alt="Logo" class="w-1/2 mb-2">
                            <label for="file" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">Choose file</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="file" class="hidden">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Telepon :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="Telepon">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Email :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="Email">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Alamat :</label>
                            <textarea name="" id="" rows="3" class="form-input-dashboard" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Deskripsi :</label>
                            <textarea name="" id="" rows="4" class="form-input-dashboard" placeholder="Deskripsi"></textarea>
                        </div>
                        <div>
                            <label for="" class="form-label-dashboard">Apakah Website Aktif :</label>
                            <select name="" id="" class="form-input-dashboard">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="form-btn-dashboard">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
