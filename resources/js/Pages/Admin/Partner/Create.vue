<script setup>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
    email: "",
    phone: "",
    password: "",
    password_confirmation: "",
    pic: "",
    photo: "",
    alamat: "",
});

const SubmitForm = () => {
    form.post("/panel/partner/store");
};
</script>

<template>
    <Head title="Tambah Partner" />

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Partner</h2>
            <form class="form-dashboard" @submit.prevent="SubmitForm">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Nama :</label
                            >
                            <input
                                type="text"
                                v-model="form.name"
                                class="form-input-dashboard"
                                placeholder="John Doe"
                            />
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Email :</label
                            >
                            <input
                                type="email"
                                v-model="form.email"
                                class="form-input-dashboard"
                                placeholder="johndoe@gmail.com"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Phone :</label
                            >
                            <input
                                type="text"
                                v-model="form.phone"
                                class="form-input-dashboard"
                                placeholder="08xxxxxxxxxx"
                            />
                            <InputError :message="form.errors.phone" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Password :</label
                            >
                            <input
                                type="password"
                                v-model="form.password"
                                class="form-input-dashboard"
                                placeholder="********"
                            />
                            <InputError :message="form.errors.password" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Password Confirmation :</label
                            >
                            <input
                                type="password"
                                v-model="form.password_confirmation"
                                class="form-input-dashboard"
                                placeholder="********"
                            />
                            <InputError
                                :message="form.errors.password_confirmation"
                            />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard"
                                >Pic :</label
                            >
                            <input
                                type="text"
                                v-model="form.pic"
                                class="form-input-dashboard"
                                placeholder="Pic"
                            />
                            <InputError :message="form.errors.pic" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard"
                                >Photo :</label
                            >
                            <label
                                for="photo"
                                class="block mb-2 cursor-pointer"
                            >
                                <div
                                    class="flex border border-gray-300 rounded-lg"
                                >
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div
                                        class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2"
                                    >
                                        Browse
                                    </div>
                                </div>
                            </label>
                            <input
                                type="file"
                                id="photo"
                                @input="form.photo = $event.target.files[0]"
                                class="hidden"
                            />
                            <InputError :message="form.errors.photo" />
                        </div>
                        <div class="mb-5">
                            <label for="alamat" class="form-label-dashboard"
                                >Alamat :</label
                            >
                            <textarea
                                v-model="form.alamat"
                                id="alamat"
                                rows="3"
                                class="form-input-dashboard"
                                placeholder="Alamat"
                            ></textarea>
                            <InputError :message="form.errors.alamat" />
                        </div>
                    </div>
                </div>
                <FormButton href="/panel/partner" text="Simpan" />
            </form>
        </div>
    </AdminLayout>
</template>
