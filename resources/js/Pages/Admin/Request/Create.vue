<script setup>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Tambah Request QR" />

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Request QR</h2>
            <form class="form-dashboard">
                <h2 class="font-semibold text-xl underline underline-offset-4 mb-5">Kode Request : 5PECTEBART</h2>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Product :</label>
                    <select name="" id="" class="form-input-dashboard">
                        <option value="">Select product</option>
                    </select>
                    <InputError message="" />
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Type QR :</label>
                    <select name="" id="" class="form-input-dashboard">
                        <option value="">Select type QR</option>
                    </select>
                    <InputError message="" />
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-2 mb-5">
                    <div class="flex-1 mb-5 sm:mb-0">
                        <label for="" class="form-label-dashboard">Harga Satuan :</label>
                        <input type="text" name="" class="form-input-dashboard" placeholder="Harga satuan">
                        <InputError message=""/>
                    </div>
                    <div class="flex-1 mb-5 sm:mb-0">
                        <label for="" class="form-label-dashboard">Qty <span class="text-red-500">(min 50, max 100.000)</span> :</label>
                        <input type="text" name="" class="form-input-dashboard" placeholder="Qty">
                        <InputError message=""/>
                    </div>
                    <div class="flex-1">
                        <label for="" class="form-label-dashboard">Total Harga :</label>
                        <input type="text" name="" class="form-input-dashboard" disabled placeholder="Total harga">
                        <InputError message=""/>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">SN Length <span class="text-red-500">(5-10 Karakter)</span> :</label>
                    <input type="text" name="" class="form-input-dashboard" placeholder="Angka 5 - 10">
                    <InputError message=""/>
                </div>
                <FormButton href="#" text="Simpan" />
            </form>
        </div>
    </AdminLayout>
</template>
