<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import ActionIcon from '@/Components/Partner/ActionIcon.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Partner/Datatable.vue';
import { computed } from 'vue';

const props = defineProps({
    filters: Object,
    product: Object
})
</script>

<template>
    <Head title="Data Customer" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Customer</h2>

            <Datatable :filters="filters" :paginationLinks="product">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Produk</th>
                            <th class="table-th">Total Scan</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="data,i in product.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ data.serial_number }}</td>
                            <td class="table-td">{{ data.name }}</td>
                            <td class="table-td">{{ data.total }}</td>
                            <td class="table-td">
                                <TableAction :detail-href="route('partner.customer.show', data.id)">
                                    <Link :href="route('partner.customer.update', data.id)" method="post" as="button">
                                        <ActionIcon>
                                            <!-- If terkunci -->
                                            <path v-if="data.status == true" stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            <!-- If terbuka -->
                                            <path v-else stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                        </ActionIcon>
                                    </Link>
                                </TableAction>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
