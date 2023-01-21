<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Edit Bisnis" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Bisnis</h2>
            <form class="form-dashboard">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Code :</label>
                            <input type="text" class="form-input-dashboard" placeholder=""/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Brand :</label>
                            <input type="text" class="form-input-dashboard" placeholder=""/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Logo :</label>
                            <img src="https://labelin.co/storage/uploads/logos/Z7fR8cK4YLNkQvI4ui9KT4epR1b99HAXmHvTNm8L.png" alt="Logo" class="w-full md:w-48 rounded mb-2"/>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="photo" class="hidden"/>
                            <InputError message="Format logo harus .png (150x200px)" />
                            <InputError message="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Company Name :</label>
                            <input type="text" class="form-input-dashboard" placeholder=""/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Manufacture Address :</label>
                            <input type="text" class="form-input-dashboard" placeholder=""/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Video :</label>
                            <video class="w-full max-h-64 rounded mb-2" controls>
                                <source src="https://labelin.co/storage/uploads/video/5tDGdq7HWWCaFe4DprxXev7wvtE0VtWbztwV3C3m.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="photo" class="hidden"/>
                            <InputError message="Format video harus .mp4 (max:3Mb)" />
                            <InputError message="" />
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
