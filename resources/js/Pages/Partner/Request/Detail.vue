<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue'

const openModal = ref(false)

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
                        <td class="table-td-detail">Toner</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Jenis QRCode</td>
                        <td class="table-td-detail">Label hologram (3x1,5cm) Landscape</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Qty</td>
                        <td class="table-td-detail">100</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Panjang Serial Number</td>
                        <td class="table-td-detail">10</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Total Pembayaran (QtyXHarga Jenis QRCode)</td>
                        <td class="table-td-detail">100,000 (100 x 1,000)</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Status</td>
                        <td class="table-td-detail">Proses Cetak QR</td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Tanggal Request</td>
                        <td class="table-td-detail">1 Januari 2023</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Bukti Pembayaran</td>
                        <td class="table-td-detail">
                            <a href="#" class="underline text-blue-500 hover:text-blue-600">Download</a>
                        </td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Tanggal Upload Bukti Bayar</td>
                        <td class="table-td-detail">3 Januari 2023</td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Jasa Kirim</td>
                        <td class="table-td-detail"></td>
                    </tr>
                    <tr class="bg-odd">
                        <td class="table-td-detail font-semibold">Nomor Resi</td>
                        <td class="table-td-detail"></td>
                    </tr>
                    <tr>
                        <td class="table-td-detail font-semibold">Riwayat</td>
                        <td class="table-td-detail">
                            <ul class="list-disc">
                                <li>2022-11-05 05:44:47 - Waiting Payment</li>
                                <li>2022-11-05 05:44:54 - Pending Payment</li>
                                <li>2022-11-05 05:45:42 - Proses Cetak QR</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="font-medium mt-8">
                <Link href="#">
                    <button class="btn-cancel mt-0">Kembali</button>
                </Link>
            </div>
        </div>
    </PartnerLayout>
</template>
