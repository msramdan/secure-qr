<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Admin/TableAction.vue';
import ButtonCreate from '@/Components/Admin/ButtonCreate.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Data Request QR"/>

    <PartnerLayout>
        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="basis-3/4">
                <div class="card-dashboard">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="card-title-dashboard mb-0">Data Request QR</h2>
                        <ButtonCreate href="#" />
                    </div>

                    <Datatable>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table-th">No</th>
                                    <th class="table-th">Kode Request</th>
                                    <th class="table-th">Produk</th>
                                    <th class="table-th">Type QR</th>
                                    <th class="table-th">Qty</th>
                                    <th class="table-th">Total Harga</th>
                                    <th class="table-th">Status</th>
                                    <th class="table-th">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="i in 10" :key="i" class="odd:bg-odd">
                                    <td class="table-td">{{ i }}</td>
                                    <td class="table-td">EHFAJWZWI7</td>
                                    <td class="table-td">Whitening Day Cream</td>
                                    <td class="table-td">Label thermal (3x1,5cm) Portrait</td>
                                    <td class="table-td">50</td>
                                    <td class="table-td">17500</td>
                                    <td class="table-td">Proses Cetak QR</td>
                                    <td class="table-td">
                                        <TableAction detail-href="#">
                                            <Link href="#">
                                                <ActionIcon>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </ActionIcon>
                                            </Link>
                                        </TableAction>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </Datatable>
                </div>
            </div>
            <div class="basis-1/4">
                <div class="card-dashboard">
                    <h2 class="card-title-dashboard">Rek Bank Pembayaran</h2>
                    <div class="bg-blue-100 p-3 rounded-lg mb-5">Setelah membuat request QR, Harap lakukan Transfer pembayaran melalui salah satu Nomor Rekening di bawah ini. dan lakukan upload pukti pembayaran berdasarkan Kode Request</div>
                    <ul>
                        <li class="border-b border-gray-300 py-5">
                            <img src="https://labelin.co/template/bca.png" alt="Bank BCA" class="w-32 mb-2">
                            <table class="w-full">
                                <tr>
                                    <td class="py-1 font-semibold md:truncate">Atas nama</td>
                                    <td class="py-1">Rahman Sunandi</td>
                                </tr>
                                <tr>
                                    <td class="py-1 font-semibold">No. Rek</td>
                                    <td class="py-1">0650812794</td>
                                </tr>
                            </table>
                        </li>
                        <li class="border-b border-gray-300 py-5">
                            <img src="https://labelin.co/template/mandiri.webp" alt="Bank Mandiri" class="w-32 mb-2">
                            <table class="w-full">
                                <tr>
                                    <td class="py-1 font-semibold md:truncate">Atas nama</td>
                                    <td class="py-1">Rahman Sunandi</td>
                                </tr>
                                <tr>
                                    <td class="py-1 font-semibold">No. Rek</td>
                                    <td class="py-1">1420020107974</td>
                                </tr>
                            </table>
                        </li>
                        <li class="pt-5">
                            <img src="https://labelin.co/template/bni.png" alt="Bank BNI" class="w-32 mb-2">
                            <table class="w-full">
                                <tr>
                                    <td class="py-1 font-semibold md:truncate">Atas nama</td>
                                    <td class="py-1">Rahman Sunandi</td>
                                </tr>
                                <tr>
                                    <td class="py-1 font-semibold">No. Rek</td>
                                    <td class="py-1">1129560062</td>
                                </tr>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </PartnerLayout>
</template>
