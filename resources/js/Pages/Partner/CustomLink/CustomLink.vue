<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Data Custom Link Resmi"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Custom Link Resmi</h2>
                <ButtonCreate href="#" />
            </div>

            <Datatable>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="table-th">No</th>
                            <th class="table-th">Name</th>
                            <th class="table-th">Link</th>
                            <th class="table-th">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in 10" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ i }}</td>
                            <td class="table-td">Whatsapp</td>
                            <td class="table-td">https://api.whatsapp.com/send?phone=6281326017009&text=Order%20via%20Whatsapp</td>
                            <td class="table-td">
                                <TableAction edit-href="#" delete-href="#"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
