<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Partner Profile" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Partner Profile</h2>
            <form class="form-dashboard">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Code :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Code"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Name :</label>
                            <input type="text" class="form-input-dashboard" placeholder="John Doe"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Email :</label>
                            <input type="email" class="form-input-dashboard" placeholder="johndoe@gmail.com"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Password :</label>
                            <input type="password" class="form-input-dashboard" placeholder="********"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Password Confirmation :</label>
                            <input type="password" class="form-input-dashboard" placeholder="********"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Pic :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Pic"/>
                            <InputError message="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Phone :</label>
                            <input type="text" class="form-input-dashboard" placeholder="08xxxxxxxxxx"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Address :</label>
                            <textarea name="" id="" rows="4" class="form-input-dashboard" placeholder="Jl. example No. 49"></textarea>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <img src="https://www.gravatar.com/avatar/e23ba5cf4a167a6f70e3baef0021f257&s=500" alt="Photo" class="w-32 rounded mb-2"/>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" id="photo" class="hidden"/>
                            <InputError message="Biarkan photo kosong jika tidak ingin diganti." />
                            <InputError message="" />
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
