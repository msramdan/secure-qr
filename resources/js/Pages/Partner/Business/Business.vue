<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Partner/Datatable.vue';

</script>

<template>
    <Head title="Data Bisnis" />

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Bisnis</h2>
                <ButtonCreate href="/panel/partner/create" />
            </div>

            <Datatable>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Code</th>
                            <th class="table-th">Company Name</th>
                            <th class="table-th">Brand</th>
                            <th class="table-th">Manufacture Address</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ + i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">{{ '11' + i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">msglowid.com</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">MS Glow</td>
                            <td class="table-td" :class="{ 'table-td-dark': i % 2 != 0 }">Malang</td>
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': i % 2 != 0 }"
                            >
                                <TableAction detail-href="#" edit-href="#" delete-href="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
