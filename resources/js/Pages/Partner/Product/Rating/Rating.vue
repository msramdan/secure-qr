<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    ratings: Object,
    all: Number,
    filters: Object,
})
</script>

<template>
    <Head title="Data Produk"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Rating Produk</h2>
                <Link :href="route('partner.produk.index')">
                    <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                        <span>Kembali</span>
                    </button>
                </Link>
            </div>

            <Datatable  :paginationLinks="ratings" :filters="filters">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Production Code</th>
                            <th class="table-th">Product Name</th>
                            <th class="table-th">Rating</th>
                            <!-- <th class="table-th">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product,i in ratings.data" :key="i" class="odd:bg-odd">
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.production_code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ product.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ (product.total_produk_rated / all).toFixed(1) }}</td>
                            <!-- <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">
                                <TableAction :detail-href="route('partner.produk.show', i)" :edit-href="route('partner.produk.edit', i)" :delete-href="route('partner.produk.destroy', i)"/>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
