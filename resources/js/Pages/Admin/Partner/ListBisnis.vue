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
            <h2 class="card-title-dashboard">Data Bisnis Partner</h2>
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
                        <tr v-for="(list, index) in Bisnis" :key="list.id" class="odd:bg-odd">
                            <td class="table-td">
                                {{ ++index }}
                            </td>
                            <td class="table-td">
                                {{ list.name }}
                            </td>
                            <td class="table-td">
                                {{ list.brand }}
                            </td>
                            <td class="table-td">
                                {{ list.manufacture }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
