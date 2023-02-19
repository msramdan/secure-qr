<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import ButtonCreate from '@/Components/Partner/ButtonCreate.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Datatable from '@/Components/Partner/Datatable.vue';

const props = defineProps({
    business: Object,
    filters: Object
})
</script>

<template>
    <Head title="Data Bisnis" />

    <PartnerLayout>
        <div class="card-dashboard">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Data Bisnis</h2>
                <ButtonCreate :href="route('partner.bisnis.create')" />
            </div>

            <Datatable :paginationLinks="business" :filters="filters">
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
                        <tr v-for="bisnis,i in business.data" :key="i">
                            <td class="table-td" :class="{ 'table-td-dark': bisnis.id % 2 != 0 }">{{ ++i }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': bisnis.id % 2 != 0 }">{{ bisnis.code }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': bisnis.id % 2 != 0 }">{{ bisnis.name }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': bisnis.id % 2 != 0 }">{{ bisnis.brand }}</td>
                            <td class="table-td" :class="{ 'table-td-dark': bisnis.id % 2 != 0 }">{{ bisnis.manufacture }}</td>
                            <td
                                class="table-td"
                                :class="{ 'table-td-dark': bisnis.id % 2 != 0 }"
                            >
                                <TableAction :detail-href="route('partner.bisnis.show', bisnis.id)" :edit-href="route('partner.bisnis.edit', bisnis.id)" :delete-href="route('partner.bisnis.destroy', bisnis.id)"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Datatable>
        </div>
    </PartnerLayout>
</template>
