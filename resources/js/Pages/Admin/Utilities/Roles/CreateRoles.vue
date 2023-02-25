<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { reactive, toRefs } from 'vue';

const props = defineProps({
    roles: Object
});

const role = reactive({
    permission: [],
    name: ''
})
const { permission } = toRefs(role)
const FormSubmit = () => {
    Inertia.post(route('admin.roles.store'), {
        name: role.name,
        permissions: permission.value
    })
}
</script>

<template>
    <Head title="Tambah Role"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Role</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama Role :</label>
                    <input type="text" v-model="role.name" id="name" class="form-input-dashboard" placeholder="Super Admin">
                </div>

                <!-- Permissions -->
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Role Permission :</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">

                        <div class="p-3 border border-gray-300 rounded-lg" v-for="role,key in roles" :key="key">
                            <div class="form-label-dashboard">{{ key }}</div>
                            <div class="space-y-0.5">
                                <div v-for="item,i in role" :key="i">
                                    <input type="checkbox" :value="item" v-model="permission" :id="item" class="rounded mr-2">
                                    <label :for="item">{{ item }}</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <FormButton :href="route('admin.roles.index')" text="Simpan"/>
            </form>
        </div>
    </AdminLayout>
</template>
