<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
const props = defineProps({
    type: Array
});
const form = useForm({
    name: props.type.name,
    price: props.type.price,
    photo: props.type.photo,
});
const submit = () => {
    form.patch(route('admin.type.update', props.type.id));
}
</script>

<template>
    <Head title="Edit Type QR"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Type QR</h2>
            <form class="form-dashboard" @submit.prevent="submit">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama :</label>
                    <input type="text" v-model="form.name" id="name" class="form-input-dashboard" placeholder="123456">
                </div>
                <div class="mb-5">
                    <label for="price" class="form-label-dashboard">Harga :</label>
                    <input type="text" v-model="form.price" id="price" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <div class="mb-5">
                    <label for="photo" class="form-label-dashboard">Photo :</label>
                    <label for="photo" class="block mb-2 cursor-pointer">
                        <div class="flex border border-gray-300 rounded-lg">
                            <div class="grow text-gray-400 px-4 py-2">Choose file</div>
                            <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                        </div>
                    </label>
                    <input type="file" id="photo" class="hidden">
                </div>
                <FormButton :href="route('admin.type.index')" text="Update"/>
            </form>
        </div>
    </AdminLayout>
</template>
