<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <!-- <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form> -->

        <div class="w-full h-full">
            <div class="mb-8">
                <h1 class="font-semibold text-4xl md:text-5xl mb-3">Register</h1>
                <div class="text-gray-500">Enter your email address and password to access website</div>
            </div>
            <form action="" class="">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama</label>
                    <input type="text" id="name" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label-dashboard">Email</label>
                    <input type="email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label-dashboard">Password</label>
                    <input type="password" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="form-label-dashboard">Password Confirmation</label>
                    <input type="password" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="flex flex-wrap md:flex-nowrap md:items-center md:justify-between mt-8">
                    <label class="flex items-center form-label-dashboard mb-5 md:mb-0">
                        <input type="checkbox" class="accent-red-500 rounded mr-2">
                        <span>I accept&nbsp;</span>
                        <a href="#" class="text-purple-1100">Terms and Conditions</a>
                    </label>
                    <button type="submit" class="btn-primary ml-auto md:ml-0">Register</button>
                </div>
            </form>
            <hr class="border-t border-gray-200 my-5">
            <div class="text-center md:text-start md:pb-10">
                Already have account? <a href="/login" class="text-purple-1100">Login</a>
            </div>
        </div>

        <template #image>
            <img src="https://images.unsplash.com/photo-1517191434949-5e90cd67d2b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGxvZ2lufGVufDB8fDB8fA%3D%3D" class="object-cover w-full h-96 md:h-full md:rounded-tr-xl">
        </template>
    </GuestLayout>
</template>
