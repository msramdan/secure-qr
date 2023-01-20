<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import ActionIcon from '@/Components/Partner/ActionIcon.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Partner/Datatable.vue';

</script>

<template>
    <Head title="Data Customer" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Data Customer</h2>

            <Datatable>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Serial Number</th>
                            <th class="table-th">Nama Produk</th>
                            <th class="table-th">Waktu Scan</th>
                            <th class="table-th">Total Scan</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ + i }}</td>
                            <td class="table-td">VQAQHL</td>
                            <td class="table-td">Whitening Day Cream</td>
                            <td class="table-td">2022-12-06 21:58:28</td>
                            <td class="table-td">11</td>
                            <td class="table-td">
                                <TableAction detail-href="#">
                                    <Link href="#">
                                        <ActionIcon>
                                            <!-- If terkunci -->
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            <!-- If terbuka -->
                                            <!-- <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /> -->
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
