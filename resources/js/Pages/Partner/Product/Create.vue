<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    category: Object,
    company: Object,
})
const form = useForm({
    production_code:'',
    category_id:'',
    bpom:'',
    expired_date:'',
    photo:'',
    product_name:'',
    business_id:'',
    description:'',
    netto:'',
})

const FormSubmit = () => {
    form.post(route('partner.produk.store'))
}
</script>

<template>
    <Head title="Tambah Product" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Product</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Production Code :</label>
                            <input type="text" v-model="form.production_code" class="form-input-dashboard" placeholder="Production code"/>
                            <InputError :message="form.errors.production_code" />
                        </div>
                        <div class="mb-5">
                            <label for="category_id" class="form-label-dashboard">Category :</label>
                            <select v-model="form.category_id" id="category_id" class="form-input-dashboard">
                                <option value="" disabled>Select category</option>
                                <option v-for="kategori in category" :value="kategori.id">{{ kategori.name }}</option>
                            </select>
                            <InputError :message="form.errors.category_id" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">BPOM :</label>
                            <input type="text" v-model="form.bpom" class="form-input-dashboard" placeholder="BPOM"/>
                            <InputError :message="form.errors.bpom" />
                        </div>
                        <div class="mb-5">
                            <label for="expired" class="form-label-dashboard">Expired Date :</label>
                            <input type="date" v-model="form.expired_date" id="expired" class="form-input-dashboard"/>
                            <InputError :message="form.errors.expired_date" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        {{ form.photo != '' ? form.photo.name : 'Choose file' }}
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.photo = $event.target.files[0]" id="photo" class="hidden"/>
                            <InputError :message="form.errors.photo" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Product Name :</label>
                            <input type="text" v-model="form.product_name" class="form-input-dashboard" placeholder="Product name"/>
                            <InputError :message="form.errors.product_name" />
                        </div>
                        <div class="mb-5">
                            <label for="company" class="form-label-dashboard">Company Name :</label>
                            <select v-model="form.business_id" id="company" class="form-input-dashboard">
                                <option value="" disabled>Select company name</option>
                                <option v-for="comp in company" :value="comp.id">{{ comp.name }}</option>
                            </select>
                            <InputError :message="form.errors.business_id" />
                        </div>
                        <div class="mb-5">
                            <label for="description" class="form-label-dashboard">Description :</label>
                            <textarea v-model="form.description" id="description" rows="4" class="form-input-dashboard" placeholder="Description"></textarea>
                            <InputError :message="form.errors.description" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Netto :</label>
                            <input type="text" v-model="form.netto" class="form-input-dashboard" placeholder="Netto"/>
                            <InputError :message="form.errors.netto" />
                        </div>
                    </div>
                </div>
                <FormButton :href="route('partner.produk.index')" text="Simpan" />
            </form>
        </div>
    </PartnerLayout>
</template>
