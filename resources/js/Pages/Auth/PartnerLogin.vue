<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('partner.auth'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <GuestLayout>
        <Head title="Login" />

        <!-- <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
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
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form> -->

        <div class="w-full">
            <div class="mb-8">
                <h1 class="font-semibold text-4xl md:text-5xl mb-3">Login</h1>
                <div class="text-gray-500">Enter your email address and password to access website</div>
            </div>
            <form @submit.prevent="submit" class="">
                <div class="mb-5">
                    <label for="email" class="form-label-dashboard">Email</label>
                    <input type="email" v-model="form.email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                </div>
                <div class="mb-5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="form-label-dashboard">Password</label>
                        <a href="#" class="form-label-dashboard text-purple-1100">Forgot password?</a>
                    </div>
                    <input type="password" v-model="form.password" id="password" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="flex items-center justify-between mt-8">
                    <label class="flex items-center form-label-dashboard mb-0">
                        <input type="checkbox" v-model="form.remember" class="accent-red-500 rounded mr-2">Remember me
                    </label>
                    <button type="submit" class="btn-primary">Login</button>
                </div>
            </form>
            <hr class="border-t border-gray-200 my-5">
            <div class="text-center md:text-start">
                Don't have an account? <a href="/register" class="text-purple-1100">Register</a>
            </div>
        </div>

        <template #image>
            <img src="https://images.unsplash.com/photo-1517191434949-5e90cd67d2b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGxvZ2lufGVufDB8fDB8fA%3D%3D" class="object-cover w-full h-96 md:h-full md:rounded-tr-xl">
        </template>
    </GuestLayout>
</template>
