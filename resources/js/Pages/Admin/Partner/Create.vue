<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Tambah Partner"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Partner</h2>
            <form class="form-dashboard" action="#">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Nama :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="John Doe">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Email :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Phone :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Password :</label>
                            <input type="password" name="" class="form-input-dashboard" placeholder="********">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Password Confirmation :</label>
                            <input type="password" name="" class="form-input-dashboard" placeholder="********">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Pic :</label>
                            <input type="text" name="" class="form-input-dashboard" placeholder="Pic">
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">Choose file</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="photo" class="hidden">
                        </div>
                        <div class="mb-5">
                            <label for="video" class="form-label-dashboard">Video :</label>
                            <label for="video" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">Choose file</div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="video" class="hidden">
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Alamat :</label>
                            <textarea name="" id="" rows="3" class="form-input-dashboard" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Simpan"/>
            </form>
        </div>
    </AdminLayout>
</template>
