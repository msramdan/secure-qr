<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Data Customer"/>

    <AdminLayout>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <h2 class="font-bold text-lg mb-5">Data Customer</h2>
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="text-left border p-3 truncate">No</th>
                            <th class="text-left border p-3 truncate">Serial Number</th>
                            <th class="text-left border p-3 truncate">Nama Produk</th>
                            <th class="text-left border p-3 truncate">Waktu Scan</th>
                            <th class="text-left border p-3 truncate">Total Scan</th>
                            <th class="text-left border p-3 truncate">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in 10">
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Action {{ n }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
