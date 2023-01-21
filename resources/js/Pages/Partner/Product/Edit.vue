<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Edit Product" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Product</h2>
            <form class="form-dashboard">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Production Code :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Production code"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Category :</label>
                            <select name="" id="" class="form-input-dashboard">
                                <option value="">Select category</option>
                            </select>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">BPOM :</label>
                            <input type="text" class="form-input-dashboard" placeholder="BPOM"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Expired Date :</label>
                            <input type="date" class="form-input-dashboard"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <img src="https://labelin.co/storage/uploads/photos/gGXhyONauVNb8NmtsKj67QnyQ5G63echfDATgYzG.png" alt="Logo" class="w-full md:w-48 rounded mb-2"/>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="photo" class="hidden"/>
                            <InputError message="Leave the Photo blank if you don`t want to change it." />
                            <InputError message="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Product Name :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Product name"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Company Name :</label>
                            <select name="" id="" class="form-input-dashboard">
                                <option value="">Select company name</option>
                            </select>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Description :</label>
                            <textarea name="" id="" rows="4" class="form-input-dashboard" placeholder="Description"></textarea>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Netto :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Netto"/>
                            <InputError message="" />
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
