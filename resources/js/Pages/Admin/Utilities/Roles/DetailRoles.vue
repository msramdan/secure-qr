<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive, toRefs } from 'vue';
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
</script>

<template>
    <Head title="Detail Role"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Role</h2>
            <form class="form-dashboard" action="#">
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Nama Role :</label>
                    <input type="text" :value="role.name" class="form-input-dashboard" value="Super Admin" disabled>
                </div>

                <!-- Permissions -->
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Role Permission :</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        <div class="p-3 border border-gray-300 rounded-lg" v-for="role,key in dataRoles" :key="key">
                            <div class="form-label-dashboard">{{ key }}</div>
                            <div class="space-y-0.5">
                                <div v-for="item,i in role" :key="i">
                                    <input type="checkbox" :id="item" class="rounded mr-2" v-bind:checked="UserPermissionArray.includes(item) == true ? true : false">
                                    <label :for="item">{{ item }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <Link :href="route('admin.roles.index')">
                    <button class="btn-cancel">Kembali</button>
                </Link>
            </form>
        </div>
    </AdminLayout>
</template>
