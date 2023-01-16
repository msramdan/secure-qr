<script setup>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    partner: Array,
});
console.log(props.partner)
const form = useForm({
    name: props.partner.name,
    email: props.partner.email,
    phone: props.partner.phone,
    password: "",
    password_confirmation: "",
    pic: props.partner.pic,
    alamat: props.partner.address,
    photo: props.partner.photo,
    id_partner: props.partner.id
});
const FormSubmit = () => {
    form.patch(route("admin.partner.update", props.partner.id));
};
</script>

<template>
    <Head title="Edit Partner" />

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Partner</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
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
                                type="text"
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
                            <InputError :message="form.errors.password_confirmation" />
                        </div>
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
                            <label for="" class="form-label-dashboard"
                                >Alamat :</label
                            >
                            <textarea
                                name=""
                                v-model="form.alamat"
                                rows="3"
                                class="form-input-dashboard"
                                placeholder="Alamat"
                            ></textarea>
                            <InputError :message="form.errors.alamat" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard"
                                >Photo :</label
                            >
                            <img
                                v-if="partner.photo == 'default.jpg'"
                                src="https://labelin.co/storage/uploads/photos/5hPS2CzpgGXS8csvvyYaoxNML3wexSJhQrjDi2OB.png"
                                alt="Logo"
                                class="w-32 rounded mb-2"
                            />
                            <img
                                v-else="partner.photo != 'default.jpg'"
                                :src="`/storage/uploads/profiles/` + partner.photo"
                                alt="profile"
                                class="w-32 rounded mb-2"
                            />
                            <label
                                for="photo"
                                class="block mb-2 cursor-pointer"
                            >
                                <div
                                    class="flex border border-gray-300 rounded-lg"
                                >
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose photo
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
                                class="hidden"
                                @input="form.photo = $event.target.files[0]"
                            />
                            <InputError :message="form.errors.photo" />
                        </div>
                    </div>
                </div>
                <FormButton
                    :href="route('admin.partner.index')"
                    text="Update"
                />
            </form>
        </div>
    </AdminLayout>
</template>

<!-- If ada video tampilkan videonya dan if ada foto tampilkan fotonya -->
