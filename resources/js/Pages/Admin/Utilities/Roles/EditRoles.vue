<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive, toRefs, watchEffect } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    dataRoles: Object,
    role: Object,
    permissionUser: Array
})
const state = reactive({
    UserPermission: props.permissionUser,
    permission: [],
    name: props.name
})
const { permission, UserPermission } = toRefs(state)
const UserPermissionArray = Object.values(UserPermission.value);
const FormUpdate = () => {
    Inertia.post(route('admin.roles.update', props.role.id), {
        _method: 'patch',
        name: state.name,
        permissions: permission.value
    })
}
const cek = (e, i) => {
    console.log(e,i);
}
</script>

<template>
    <Head title="Edit Role"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Role</h2>
            <form class="form-dashboard" @submit.prevent="FormUpdate">
                <div class="mb-5">
                    <label for="name" class="form-label-dashboard">Nama Role :</label>
                    <input type="text" v-model="role.name" id="name" class="form-input-dashboard" placeholder="Super Admin">
                </div>

                <!-- Permissions -->
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Role Permission :</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        <div class="p-3 border border-gray-300 rounded-lg" v-for="role,key in dataRoles" :key="key">
                            <div class="form-label-dashboard">{{ key }}</div>
                            <div class="space-y-0.5">
                                <div v-for="item,i in role" :key="i">
                                    <input type="checkbox" :value="item" v-model="permission" :id="item" class="rounded mr-2" v-bind:checked="UserPermissionArray.includes(item) == true ? true : false">
                                    <label :for="item">{{ item }}</label>
                                    <!-- <div>{{ UserPermissionArray.includes(item) == true ? UserPermissionArray.includes(item) : "ASU" }}</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <FormButton :href="route('admin.roles.index')" text="Update"/>
            </form>
        </div>
    </AdminLayout>
</template>
