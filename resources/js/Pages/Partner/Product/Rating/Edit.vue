<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    product: Object,
    categories: Object,
    businesses: Object
})

const form = useForm({
    production_code: props.product.production_code,
    bpom: props.product.bpom,
    expired_date: props.product.expired_date,
    product_name: props.product.name,
    description: props.product.description,
    netto: props.product.netto,
    category_id: props.product.category_id,
    business_id: props.product.business_id,
    photo: '',
})

const FormUpdate = () => {
    Inertia.post(route('partner.produk.update', props.product.id), {
        _method: 'patch',
        production_code: form.production_code,
        bpom: form.bpom,
        expired_date: form.expired_date,
        name: form.product_name,
        description: form.description,
        netto: form.netto,
        category_id: form.category_id,
        business_id: form.business_id,
        photo: form.photo,
    })
}
</script>

<template>
    <Head title="Edit Product" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Rating Produk</h2>
            <form class="form-dashboard" @submit.prevent="FormUpdate">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="production_code" class="form-label-dashboard">Production Code :</label>
                            <input type="text" v-model="form.production_code" id="production_code" class="form-input-dashboard" placeholder="Production code"/>
                            <InputError :message="form.errors.production_code" />
                        </div>
                        <div class="mb-5">
                            <label for="category" class="form-label-dashboard">Category :</label>
                            <select v-model="form.category_id" id="category" class="form-input-dashboard">
                                <option value="" disabled>Select category</option>
                                <option v-for="category in categories" :value="category.id" :selected="form.category_id == category.id">{{ category.name }}</option>
                            </select>
                            <InputError :message="form.errors.category_id" />
                        </div>
                        <div class="mb-5">
                            <label for="bpom" class="form-label-dashboard">BPOM :</label>
                            <input type="text" v-model="form.bpom" id="bpom" class="form-input-dashboard" placeholder="BPOM"/>
                            <InputError :message="form.errors.bpom" />
                        </div>
                        <div class="mb-5">
                            <label for="expired_date" class="form-label-dashboard">Expired Date :</label>
                            <input type="date" v-model="form.expired_date" id="expired_date" class="form-input-dashboard"/>
                            <InputError :message="form.errors.expired_date" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <img :src="`/storage/uploads/photos/` + product.photo" alt="Logo" class="w-full md:w-48 rounded mb-2"/>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        {{ form.photo != '' ? form.photo.name : 'Choose file' }}
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.photo = $event.target.files[0]" id="photo" class="hidden"/>
                            <InputError message="Leave the Photo blank if you don`t want to change it." />
                            <InputError :message="form.errors.photo" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="product_name" class="form-label-dashboard">Product Name :</label>
                            <input type="text" v-model="form.product_name" id="product_name" class="form-input-dashboard" placeholder="Product name"/>
                            <InputError :message="form.errors.product_name" />
                        </div>
                        <div class="mb-5">
                            <label for="company" class="form-label-dashboard">Company Name :</label>
                            <select v-model="form.business_id" id="company" class="form-input-dashboard">
                                <option value="" disabled>Select company name</option>
                                <option v-for="bisnis in businesses" :value="bisnis.id" :selected="bisnis.id == product.business_id">{{ bisnis.name }}</option>
                            </select>
                            <InputError :message="form.errors.business_id" />
                        </div>
                        <div class="mb-5">
                            <label for="description" class="form-label-dashboard">Description :</label>
                            <textarea v-model="form.description" id="description" rows="4" class="form-input-dashboard" placeholder="Description"></textarea>
                            <InputError :message="form.errors.description" />
                        </div>
                        <div class="mb-5">
                            <label for="netto" class="form-label-dashboard">Netto :</label>
                            <input type="text" v-model="form.netto" id="netto" class="form-input-dashboard" placeholder="Netto"/>
                            <InputError :message="form.errors.netto" />
                        </div>
                    </div>
                </div>
                <FormButton :href="route('partner.produk.index')" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
