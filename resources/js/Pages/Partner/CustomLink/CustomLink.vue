<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    filters: Object,
    links: Object
})
</script>

<template>
    <Head title="Data Custom Link Resmi"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Custom Link Resmi</h2>
                <ButtonCreate :href="route('partner.links.create')" />
            </div>

            <Datatable :filters="filters" :paginationLinks="links">
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
                        <tr v-for="data, i in links.data" :key="i" class="odd:bg-odd">
                            <td class="table-td">{{ ++i }}</td>
                            <td class="table-td">{{ data.name }}</td>
                            <td class="table-td">{{ data.link }}</td>
                            <td class="table-td">
                                <TableAction :edit-href="route('partner.links.edit', data.code)" :delete-href="route('partner.links.destroy', data.code)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
