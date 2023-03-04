<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
const props = defineProps({
    category: Array
});
const form = useForm({
    id: props.category.id,
    name: props.category.name
});
const submit = () => {
    form.patch(route('admin.category.update', form.id))
}
</script>

<template>
    <Head title="Edit Kategori"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Kategori</h2>
            <form class="form-dashboard" @submit.prevent="submit">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama :</label>
                    <input type="text" v-model="form.name" id="name" class="form-input-dashboard" placeholder="John Doe">
                </div>
                <FormButton :href="route('admin.category.index')" text="Update"/>
            </form>
        </div>
    </AdminLayout>
</template>
