<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    request: Object
})
</script>

<template>
    <Head title="Detail Request QR"/>

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Detail Request QR</h2>
            <table class="table">
                <tbody>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Nama Produk</td>
                        <td class="table-td-detail">{{ request.product.name }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Jenis QRCode</td>
                        <td class="table-td-detail">{{ request.type_qrcode.name }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Qty</td>
                        <td class="table-td-detail">{{ request.qty }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Panjang Serial Number</td>
                        <td class="table-td-detail">{{ request.sn_length }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Total Pembayaran (QtyXHarga Jenis QRCode)</td>
                        <td class="table-td-detail">{{ request.amount_price }} ({{ request.qty }} x {{ request.harga_satuan }})</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Status</td>
                        <td class="table-td-detail">{{ request.status }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Tanggal Request</td>
                        <td class="table-td-detail">{{ request.tanggal_request }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Bukti Pembayaran</td>
                        <td class="table-td-detail">
                            <a :href="route('partner.request.download', request.bukti_pembayaran)" class="underline text-blue-500 hover:text-blue-600" v-if="request.bukti_pembayaran">Download</a>
                        </td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Tanggal Upload Bukti Bayar</td>
                        <td class="table-td-detail">{{ request.tgl_upload_bukti_bayar }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Jasa Kirim</td>
                        <td class="table-td-detail">{{ request.jasa_kirim ?? '' }}</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Nomor Resi</td>
                        <td class="table-td-detail">{{ request.no_resi ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Riwayat</td>
                        <td class="table-td-detail">
                            <ul class="list-disc">
                                <li v-for="history in request.histories">{{ history.created_at }} - {{ history.status }}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="font-medium mt-8">
                <Link :href="route('partner.request.index')">
                    <button class="btn-cancel mt-0">Kembali</button>
                </Link>
            </div>
        </div>
    </PartnerLayout>
</template>
