<script setup>
import PartnerLayout from "@/Layouts/Backend/AdminLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
    profile: Object
})
const form = useForm({
    name: props.profile.name,
    email: props.profile.email,
    password: '',
    password_confirmation: ''
})
const UpdateProfile = () => {
    Inertia.post(route('admin.profil.update', props.profile.code), {
        _method: 'patch',
        name: form.name,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
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
                    </div>
                </div>
                <div class="flex items-center space-x-2 font-medium mt-8">
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </div>
    </PartnerLayout>
</template>
