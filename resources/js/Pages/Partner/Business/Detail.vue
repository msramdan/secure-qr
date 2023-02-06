<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    business: Object
})
</script>

<template>
    <Head title="Detail Partner"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Bisnis</h2>
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Code</td>
                            <td class="table-td-detail">{{ business.code }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Name</td>
                            <td class="table-td-detail">{{ business.name }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Brand</td>
                            <td class="table-td-detail">{{ business.brand }}</td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold">Manufacture</td>
                            <td class="table-td-detail">{{ business.manufacture }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold">Photo</td>
                            <td class="table-td-detail">
                                <img :src="`/storage/uploads/logos/` + business.logo" alt="Logo" class="md:w-48 rounded">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-td-detail font-semibold md:truncate">Created At</td>
                            <td class="table-td-detail">{{ business.created_at }}</td>
                        </tr>
                        <tr class="bg-odd">
                            <td class="table-td-detail font-semibold md:truncate">Updated At</td>
                            <td class="table-td-detail">{{ business.updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center space-x-2 font-medium mt-8">
                <Link :href="route('partner.bisnis.index')">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
                </Link>
            </div>
        </div>
    </PartnerLayout>
</template>
