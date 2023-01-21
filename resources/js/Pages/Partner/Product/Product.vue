<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Data Produk"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Produk</h2>
                <ButtonCreate href="#" />
            </div>

            <Datatable>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Production Code</th>
                            <th class="table-th">Product Name</th>
                            <th class="table-th">Business</th>
                            <th class="table-th">Category</th>
                            <th class="table-th">BPOM</th>
                            <th class="table-th">Description</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">1011</td>
                            <td class="table-td">Whitening Day Cream</td>
                            <td class="table-td">msglowid.com</td>
                            <td class="table-td">Kosmetik</td>
                            <td class="table-td">NA18190123141</td>
                            <td class="table-td">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et, amet? Iure ratione quisquam voluptatum vero labore quod consectetur esse, ex tempore laborum autem aspernatur enim sequi molestiae. Eius, ipsam voluptates?</td>
                            <td class="table-td">
                                <TableAction detail-href="#" edit-href="#" delete-href="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
