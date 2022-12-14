<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Dashboard"/>

    <AdminLayout>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-y-5 md:gap-x-8 md:gap-y-0 mb-8">
            <div v-for="n in 4" :key="n" class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam aut blanditiis eius veniam, velit illum architecto sit tenetur nemo ad exercitationem, rem dolor consequatur.</div>
        </div>
        <div class="bg-white p-4 lg:p-6 rounded-2xl shadow-main">
            <h2 class="font-bold text-lg mb-5">Datatable</h2>
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="text-left border p-3 truncate">Column 1</th>
                            <th class="text-left border p-3 truncate">Column 2</th>
                            <th class="text-left border p-3 truncate">Column 3</th>
                            <th class="text-left border p-3 truncate">Column 4</th>
                            <th class="text-left border p-3 truncate">Column 5</th>
                            <th class="text-left border p-3 truncate">Column 6</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="n in 10">
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                            <td class="border p-3" :class="{ 'bg-[#F2F2F2]': n % 2 != 0 }">Row {{ n }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>
