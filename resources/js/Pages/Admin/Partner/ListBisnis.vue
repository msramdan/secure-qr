<script setup>
import AdminLayout from "@/Layouts/Backend/AdminLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
const props = defineProps({
    Bisnis: Array,
});
</script>

<template>
    <Head title="Data Bisnis Partner" />

    <AdminLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard">Data Bisnis Partner</h2>
                <Link :href="route('admin.partner.index')">
                    <button
                        class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg"
                    >
                        Kembali
                    </button>
                </Link>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Name</th>
                            <th class="table-th">Brand</th>
                            <th class="table-th">Manufacture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in Bisnis" :key="list.id">
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': list.id % 2 != 0 }"
                            >
                                {{ ++index }}
                            </td>
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': list.id % 2 != 0 }"
                            >
                                {{ list.name }}
                            </td>
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': list.id % 2 != 0 }"
                            >
                                {{ list.brand }}
                            </td>
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': list.id % 2 != 0 }"
                            >
                                {{ list.manufacture }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
