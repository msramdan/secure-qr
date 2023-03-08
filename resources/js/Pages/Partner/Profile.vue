<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
    profile: Object
})
const form = useForm({
    name: props.profile.name,
    phone: props.profile.phone,
    pic: props.profile.pic,
    photo: '',
    address: props.profile.address,
    email: props.profile.email,
    password: '',
    password_confirmation: ''
})
const UpdateProfile = () => {
    Inertia.post(route('partner.profil.update', props.profile.code), {
        _method: 'patch',
        name: form.name,
        phone: form.phone,
        pic: form.pic,
        photo: form.photo,
        address: form.address,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
    }, {
        onSuccess: () => {
            form.photo = ''
        }
    })
}
</script>

<template>
    <Head title="Partner Profile" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Partner Profile</h2>
            <form class="form-dashboard" @submit.prevent="UpdateProfile">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="name" class="form-label-dashboard">Name :</label>
                            <input type="text" v-model="form.name" id="name" class="form-input-dashboard" placeholder="John Doe"/>
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="form-label-dashboard">Email :</label>
                            <input type="email" v-model="form.email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com"/>
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="mb-5">
                            <label for="password" class="form-label-dashboard">Password :</label>
                            <input type="password"  v-model="form.password" id="password" class="form-input-dashboard" placeholder="********"/>
                            <InputError :message="form.errors.password" />
                        </div>
                        <div class="mb-5">
                            <label for="password_confirmation" class="form-label-dashboard">Password Confirmation :</label>
                            <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-input-dashboard" placeholder="********"/>
                            <InputError :message="form.errors.password_confirmation" />
                        </div>
                        <div class="mb-5">
                            <label for="pic" class="form-label-dashboard">Pic :</label>
                            <input type="text" v-model="form.pic" id="pic" class="form-input-dashboard" placeholder="Pic"/>
                            <InputError :message="form.errors.pic" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="phone" class="form-label-dashboard">Phone :</label>
                            <input type="text" v-model="form.phone" id="phone" class="form-input-dashboard" placeholder="08xxxxxxxxxx"/>
                            <InputError :message="form.errors.phone" />
                        </div>
                        <div class="mb-5">
                            <label for="address" class="form-label-dashboard">Address :</label>
                            <textarea  v-model="form.address" id="address" rows="4" class="form-input-dashboard" placeholder="Jl. example No. 49"></textarea>
                            <InputError :message="form.errors.address" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Photo :</label>
                            <img v-if="profile.photo == 'default.jpg'" src="https://www.gravatar.com/avatar/e23ba5cf4a167a6f70e3baef0021f257&s=500" alt="Logo" class="w-32 rounded mb-2"/>
                            <img v-else="profile.photo != 'default.jpg'" :src="`/storage/uploads/profiles/` + profile.photo" alt="profile" class="w-32 rounded mb-2"/>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        {{ form.photo != '' ? form.photo.name : 'Choose file' }}
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.photo = $event.target.files[0]" id="photo" class="hidden"/>
                            <InputError message="Biarkan photo kosong jika tidak ingin diganti." />
                            <InputError :message="form.errors.photo" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2 font-medium mt-8">
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </div>
    </PartnerLayout>
</template>
