<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import Datatable from '@/Components/Admin/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    users: Object,
    filters: Object
})
</script>

<template>
    <Head title="Data User"/>

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data User</h2>
                <ButtonCreate :href="route('admin.users.create')"/>
            </div>
            <Datatable :paginationLinks="users" :filters="filters">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Nama User</th>
                            <th class="table-th">Email</th>
                            <th class="table-th">Role</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user,i in users.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ user.name }}</td>
                            <td class="table-td">{{ user.email }}</td>
                            <td class="table-td">{{ user.role[0].name}}</td>
                            <td class="table-td">
                                <TableAction :edit-href="route('admin.users.edit', user.code)" :delete-href="route('admin.users.destroy', user.code)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </AdminLayout>
</template>
