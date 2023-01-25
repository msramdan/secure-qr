<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue'

const openModal = ref(false)

</script>

<template>
    <Head title="Detail Request QR"/>

    <AdminLayout>
        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="basis-2/3">
                <div class="card-dashboard">
                    <h2 class="card-title-dashboard">Detail Request QR</h2>
                    <table class="table">
                        <tbody>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Nama Partner</td>
                                <td class="table-td-detail">John Doe</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Nama Produk</td>
                                <td class="table-td-detail">Toner</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Jenis QRCode</td>
                                <td class="table-td-detail">Label hologram (3x1,5cm) Landscape</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Qty</td>
                                <td class="table-td-detail">100</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Panjang Serial Number</td>
                                <td class="table-td-detail">10</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Total Pembayaran (QtyXHarga Jenis QRCode)</td>
                                <td class="table-td-detail">100,000 (100 x 1,000)</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Status</td>
                                <td class="table-td-detail">Proses Cetak QR</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Request</td>
                                <td class="table-td-detail">1 Januari 2023</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Bukti Pembayaran</td>
                                <td class="table-td-detail">
                                    <a href="#" class="underline text-blue-500 hover:text-blue-600">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Upload Bukti Bayar</td>
                                <td class="table-td-detail">3 Januari 2023</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Status Generate QRCode</td>
                                <td class="table-td-detail">Sudah Generate</td>
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
                    <div class="flex flex-wrap-reverse sm:space-x-2 font-medium mt-8">
                        <Link href="#">
                            <button class="btn-cancel mt-0">Kembali</button>
                        </Link>
                        <div class="flex space-x-2 mb-5 sm:mb-0">
                            <button type="button" @click="openModal = true" class="btn-primary">Update Resi</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Download File Excel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="basis-1/3">
                <div class="card-dashboard">
                    <h2 class="card-title-dashboard">Detail Request QR</h2>
                    <table class="table">
                        <tbody>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Nama</td>
                                <td class="table-td-detail">John Doe</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Email</td>
                                <td class="table-td-detail">johndoe@gmail.com</td>
                            </tr>
                            <tr class="bg-odd">
                                <td class="table-td-detail font-semibold">Telepon</td>
                                <td class="table-td-detail">08xxxxxxxxxx</td>
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

        <Modal :open-modal="openModal" modal-title="Update No. Resi" @closeModal="openModal = false">
            <form action="#">
                <div class="mb-5">
                    <label for="nama" class="form-label-dashboard">Ekspedisi :</label>
                    <input class="form-input-dashboard" type="text" name="nama" placeholder="Ekspedisi">
                </div>
                <div>
                    <label for="no_tlp" class="form-label-dashboard">No. Resi :</label>
                    <input class="form-input-dashboard" type="text" name="no_tlp" placeholder="Nomor Resi">
                </div>
                <div class="flex items-center justify-end space-x-2 font-medium mt-8 pb-5">
                    <button @click="openModal = false" class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </Modal>
    </AdminLayout>
</template>
