<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const openModal = ref(false)

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
                <div class="text-gray-500">Enter your information to register to this website.</div>
            </div>
            <form action="" class="">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama Lengkap<span class="text-red-500">*</span></label>
                    <input type="text" id="name" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="email" class="form-label-dashboard">Email<span class="text-red-500">*</span></label>
                    <input type="email" id="email" class="form-input-dashboard" placeholder="johndoe@gmail.com">
                </div>
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Phone<span class="text-red-500">*</span></label>
                    <input type="text" id="name" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Address<span class="text-red-500">*</span></label>
                    <input type="text" id="name" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="password" class="form-label-dashboard">Password<span class="text-red-500">*</span></label>
                    <input type="password" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="form-label-dashboard">Password Confirmation<span class="text-red-500">*</span></label>
                    <input type="password" class="form-input-dashboard" placeholder="********">
                </div>
                <div class="flex flex-wrap md:flex-nowrap md:items-center md:justify-between mt-8">
                    <label class="flex items-center form-label-dashboard mb-5 md:mb-0">
                        <input type="checkbox" class="accent-red-500 rounded mr-2">
                        <span>Setujui&nbsp;</span>
                        <button type="button" @click="openModal = true" class="text-purple-1100">Syarat dan Ketentuan Berlaku</button>
                    </label>
                    <button type="submit" class="btn-primary ml-auto md:ml-0">Register</button>
                </div>
            </form>
            <hr class="border-t border-gray-200 my-5">
            <div class="text-center md:text-start md:pb-10">
                Already have an account? <a :href="route('partner.login')" class="text-purple-1100">Login</a>
            </div>
        </div>

        <template #image>
            <img src="https://images.unsplash.com/photo-1517191434949-5e90cd67d2b6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTF8fGxvZ2lufGVufDB8fDB8fA%3D%3D" class="object-cover w-full h-96 md:h-full md:rounded-tr-xl">
        </template>


        <Modal :open-modal="openModal" modal-title="Syarat dan Ketentuan Berlaku" @closeModal="openModal = false">
            <div class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente eligendi ipsa natus delectus consectetur saepe at inventore molestiae exercitationem quaerat, veritatis, et neque blanditiis maiores tenetur odit earum doloribus fugiat tempora cupiditate quo. Dolor aliquid accusamus magnam explicabo aut magni mollitia, ratione nisi iste veritatis totam? Reprehenderit, eveniet impedit. Mollitia qui accusamus, ipsa sit placeat rem facilis maxime excepturi obcaecati temporibus id nesciunt laboriosam blanditiis saepe vero distinctio? Laudantium quidem expedita amet repudiandae deserunt culpa magni, ratione fugit iste, nulla laborum dolor illum vel molestiae ad beatae ipsa quibusdam suscipit libero. Quas corporis sint praesentium rerum at sapiente dignissimos voluptatem? Voluptatum atque magni numquam soluta quidem ipsa sapiente est, vitae iusto ratione, cupiditate hic. Non repudiandae impedit voluptatibus temporibus odio nam sint hic a? Natus tempore illum aspernatur modi fugiat error quasi saepe facere voluptates alias molestias hic ratione doloremque sapiente laborum odit fugit non, aut, ipsum aliquam recusandae distinctio quia. Minus tempora deserunt perspiciatis impedit, sit possimus quod omnis iste id odit non vitae amet laudantium sint accusamus dignissimos est pariatur voluptates nemo debitis, dolores delectus temporibus. Autem dolore sint error mollitia provident ipsum laborum eos quasi ut facilis dolores a aliquam atque repellendus facere praesentium corrupti beatae fugit consequatur, nesciunt, delectus sequi distinctio odit. Animi dolores alias minus dolorum ab eos dolore nam ducimus, eligendi veniam possimus ipsam odio quo quos veritatis obcaecati eveniet iusto quis eum nisi sunt culpa saepe? Animi, earum nisi dicta provident tempore veniam placeat officia? Dolore soluta, deleniti atque sint, beatae molestiae, doloribus dolores quis expedita sunt hic pariatur totam nobis reprehenderit quod quibusdam dignissimos officiis neque a accusamus. Laudantium aut, fuga itaque asperiores iure dolores. Qui corporis aspernatur sapiente. Blanditiis ab facere iusto voluptates enim! Laudantium blanditiis, deserunt magni deleniti architecto, dolore nihil numquam consequuntur ducimus et ipsam quia laborum vitae. Eveniet eum assumenda, facere magni voluptatem animi odit aspernatur! Similique, velit quidem sapiente quam hic exercitationem voluptates? Repellendus qui nihil sint eos impedit accusamus tempora ratione aperiam delectus veritatis, nobis quos iste earum hic iure provident, pariatur blanditiis! Sapiente eligendi ab incidunt? Aliquam rem et earum soluta corporis dolorum repellat voluptate nulla voluptatum neque aut eveniet fugiat ipsum quos itaque voluptas dolor, labore libero deserunt debitis ab amet obcaecati accusamus. Aperiam ullam ex omnis autem. Quam nostrum officiis dolor tempore. Similique exercitationem totam non deserunt cum, excepturi dicta quae deleniti vel inventore impedit placeat mollitia praesentium nam labore reprehenderit maxime quod. Esse, sapiente. Reprehenderit nostrum facere recusandae sit suscipit dolore deserunt soluta possimus officia repellat a, nobis neque nihil odio, quasi consequuntur harum at excepturi cum pariatur inventore illum aspernatur fuga iusto. Fuga quis omnis incidunt nihil, provident harum consequuntur rerum tempora ab soluta culpa sequi. Accusamus, ex perspiciatis non maiores magni alias est laborum, odit sapiente dicta nisi quisquam officiis fugiat amet incidunt nulla? Mollitia voluptas voluptatum, molestiae adipisci sit nostrum quasi? Necessitatibus molestiae exercitationem nobis sequi molestias cumque voluptatem atque est recusandae, odit omnis similique saepe quod dolores, excepturi enim. Quia at a obcaecati amet suscipit voluptatum laudantium recusandae.</div>
            <div class="sticky bottom-0 bg-white py-5">
                <div class="flex items-center justify-end space-x-2 font-medium">
                    <button @click="openModal = false" class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Close</button>
                </div>
            </div>
        </Modal>
    </GuestLayout>
</template>
