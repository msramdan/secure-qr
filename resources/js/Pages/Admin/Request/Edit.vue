<script setup>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    request: Object,
    type: Object,
    product: Object
})
const form = useForm({
    product_id: props.request.product_id,
    type_qrcode_id: props.request.type_qrcode_id,
    harga_satuan: props.request.harga_satuan,
    qty: props.request.qty,
    amount_price: props.request.amount_price,
    sn_length: props.request.sn_length,
})
const calculateAmountPrice = () => {
    form.amount_price = form.harga_satuan * form.qty
}
const FormUpdate = (e) => {
    Inertia.post(route('admin.request.update', e), {
        _method: 'patch',
        product_id: form.product_id,
        type_qrcode_id: form.type_qrcode_id,
        harga_satuan: form.harga_satuan,
        qty: form.qty,
        amount_price: form.amount_price,
        sn_length: form.sn_length,
    })
}
</script>

<template>
    <Head title="Tambah Request QR" />

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Request QR</h2>
            <form class="form-dashboard" @submit.prevent="FormUpdate(request.id)">
                <h2 class="font-semibold text-xl underline underline-offset-4 mb-5">Kode Request : {{ request.code }}</h2>
                <div class="mb-5">
                    <label for="product" class="form-label-dashboard">Product :</label>
                    <select v-model="form.product_id" id="product" class="form-input-dashboard">
                        <option value="" disabled>Select product</option>
                        <option :value="produk.id" v-for="produk in product" :selected="produk.id == request.product_id">{{ produk.partner.name }} - {{ produk.name }}</option>
                    </select>
                    <InputError :message="form.errors.product_id" />
                </div>
                <div class="mb-5">
                    <label for="type" class="form-label-dashboard">Type QR :</label>
                    <select v-model="form.type_qrcode_id" id="type" class="form-input-dashboard">
                        <option value="" disabled>Select type QR</option>
                        <option :value="jenis.id" v-for="jenis in type" :selected="jenis.id == request.type_qrcode_id">{{ jenis.name }}</option>
                    </select>
                    <InputError :message="form.errors.type_qrcode_id" />
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-2 mb-5">
                    <div class="flex-1 mb-5 sm:mb-0">
                        <label for="harga_satuan" class="form-label-dashboard">Harga Satuan :</label>
                        <input type="text" v-model="form.harga_satuan" id="harga_satuan" class="form-input-dashboard" placeholder="Harga satuan" @input="calculateAmountPrice">
                        <InputError :message="form.errors.harga_satuan"/>
                    </div>
                    <div class="flex-1 mb-5 sm:mb-0">
                        <label for="qty" class="form-label-dashboard">Qty <span class="text-red-500">(min 50, max 100.000)</span> :</label>
                        <input type="text" v-model="form.qty" id="qty" class="form-input-dashboard" placeholder="Qty" @input="calculateAmountPrice">
                        <InputError :message="form.errors.qty"/>
                    </div>
                    <div class="flex-1">
                        <label for="amount_price" class="form-label-dashboard">Total Harga :</label>
                        <input type="text" v-model="form.amount_price" class="form-input-dashboard" disabled placeholder="Total harga">
                        <InputError :message="form.errors.amount_price"/>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="sn_length" class="form-label-dashboard">SN Length <span class="text-red-500">(5-10 Karakter)</span> :</label>
                    <input type="text" v-model="form.sn_length" id="sn_length" class="form-input-dashboard" placeholder="Angka 5 - 10">
                    <InputError :message="form.errors.sn_length"/>
                </div>
                <FormButton :href="route('admin.request.index')" text="Simpan" />
            </form>
        </div>
    </AdminLayout>
</template>
