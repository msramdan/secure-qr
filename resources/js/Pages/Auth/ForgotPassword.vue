<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <!-- <div>
            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                link that will allow you to choose a new one.
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
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

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </PrimaryButton>
                </div>
            </form>
        </div> -->

        <div class="w-full">
            <div class="mb-8">
                <h1 class="font-semibold text-4xl md:text-5xl mb-3">Reset Password</h1>
                <div class="text-gray-500">Enter your email address and we'll send you an email with instructions to reset your password.</div>
            </div>
            <form action="" class="">
                <div class="mb-5">
                    <label for="email" class="form-label-dashboard">Email</label>
                    <input type="email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                </div>
                <div class="flex justify-end mt-8">
                    <button type="submit" class="btn-primary">Reset Password</button>
                </div>
            </form>
        </div>

        <template #image>
            <img src="https://images.unsplash.com/photo-1517191434949-5e90cd67d2b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGxvZ2lufGVufDB8fDB8fA%3D%3D" class="object-cover w-full h-96 md:h-full md:rounded-tr-xl">
        </template>
    </GuestLayout>
</template>
