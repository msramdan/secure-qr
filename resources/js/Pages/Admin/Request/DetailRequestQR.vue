<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Detail Request QR"/>

    <AdminLayout>
        <div class="flex flex-col lg:flex-row lg:space-x-8">
            <div class="basis-2/3">
                <div class="card-dashboard">
                    <h2 class="card-title-dashboard">Detail Request QR</h2>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Nama Partner</td>
                                <td class="table-td-detail table-td-dark">John Doe</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Nama Produk</td>
                                <td class="table-td-detail">Toner</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Jenis QRCode</td>
                                <td class="table-td-detail table-td-dark">Label hologram (3x1,5cm) Landscape</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Qty</td>
                                <td class="table-td-detail">100</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Panjang Serial Number</td>
                                <td class="table-td-detail table-td-dark">10</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Total Pembayaran (QtyXHarga Jenis QRCode)</td>
                                <td class="table-td-detail">100,000 (100 x 1,000)</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Status</td>
                                <td class="table-td-detail table-td-dark">Proses Cetak QR</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Request</td>
                                <td class="table-td-detail">1 Januari 2023</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Bukti Pembayaran</td>
                                <td class="table-td-detail table-td-dark">
                                    <a href="#" class="underline text-blue-500 hover:text-blue-600">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Upload Bukti Bayar</td>
                                <td class="table-td-detail">3 Januari 2023</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Status Generate QRCode</td>
                                <td class="table-td-detail table-td-dark">Sudah Generate</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Jasa Kirim</td>
                                <td class="table-td-detail"></td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Nomor Resi</td>
                                <td class="table-td-detail table-td-dark"></td>
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
                    <div class="flex items-center space-x-2 font-medium mt-8">
                        <Link href="#">
                            <button class="btn-cancel mt-0">Kembali</button>
                        </Link>
                        <button class="btn-primary">Update Resi</button>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Download File Excel</button>
                    </div>
                </div>
            </div>
            <div class="basis-1/3">
                <div class="card-dashboard">
                    <h2 class="card-title-dashboard">Detail Request QR</h2>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Nama</td>
                                <td class="table-td-detail table-td-dark">John Doe</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Email</td>
                                <td class="table-td-detail">johndoe@gmail.com</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Telepon</td>
                                <td class="table-td-detail table-td-dark">08xxxxxxxxxx</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Alamat</td>
                                <td class="table-td-detail">Jawa Barat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
