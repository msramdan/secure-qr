<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue'

const openModal = ref(false)
const props = defineProps({
  Qr: Array,
  histories: Array
})
const form = useForm({
    request_id: props.Qr.id,
    qty: props.Qr.qty,
    sn_length: props.Qr.sn_length,
    ekspedisi: '',
    no_resi:''
})
const Proses = () => { 
    form.post(route('admin.request.upProgress'))
}
const GenerateQR = () => { 
    form.post(route('admin.request.generate'))
}
const KirimPaket = () => { 
    try {
        form.post(route('admin.request.upResi'));
        openModal.value = false
    } catch (error) {
        // console.log(error.getMessage);
    }
}
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
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Nama Partner</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.nama_partner }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Nama Produk</td>
                                <td class="table-td-detail">{{ Qr.nama_produk }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Jenis QRCode</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.jenis_qr }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Qty</td>
                                <td class="table-td-detail">{{ Qr.qty }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Panjang Serial Number</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.sn_length }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Total Pembayaran (QtyXHarga Jenis QRCode)</td>
                                <td class="table-td-detail">{{ Qr.amount_price }} ({{ Qr.qty }} x {{ Qr.harga_satuan }})</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Status</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.status }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Request</td>
                                <td class="table-td-detail">{{ Qr.tanggal_request }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Bukti Pembayaran</td>
                                <td class="table-td-detail table-td-dark">
                                    <a :href="route('admin.request.download', Qr.bukti_pembayaran)" v-if="Qr.bukti_pembayaran" class="underline text-blue-500 hover:text-blue-600">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Tanggal Upload Bukti Bayar</td>
                                <td class="table-td-detail">{{ Qr.tgl_upload_bukti_bayar }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Status Generate QRCode</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.is_generate ?? 'Belum Generate' }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Jasa Kirim</td>
                                <td class="table-td-detail">{{ Qr.jasa_kirim }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Nomor Resi</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.no_resi }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Riwayat</td>
                                <td class="table-td-detail">
                                    <ul class="list-disc" v-for="histori,i in histories" :key="i">
                                        <li>{{ histori.created_at }} - {{ histori.status }}</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex items-center space-x-2 font-medium mt-8">
                        <Link :href="route('admin.request.index')">
                            <button class="btn-cancel mt-0">Kembali</button>
                        </Link>
                        <form @submit.prevent="Proses" v-if="Qr.status == 'Pending Payment'">
                          <input type="hidden" v-model="form.request_id">
                          <button class="btn-primary" type="submit">Proses Request</button>
                        </form>
                        <form @submit.prevent="GenerateQR" v-if="Qr.status == 'Proses Cetak QR' && Qr.is_generate == null">
                          <input type="hidden" v-model="form.request_id">
                          <input type="hidden" v-model="form.qty">
                          <input type="hidden" v-model="form.sn_length">
                          <button class="btn-primary">Generate</button>
                        </form>
                          <button v-if="Qr.status != 'Dalam Pengiriman' && Qr.is_generate == 'Sudah Generate'"  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg" type="button" @click="openModal = true">Update Resi</button>
                        <a :href="route('admin.export.Qr', Qr.id)" v-if="Qr.is_generate != null" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" target="_blank" rel="noopener noreferrer">Download File Excel</a>
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
                                <td class="table-td-detail table-td-dark">{{ Qr.nama_partner }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Email</td>
                                <td class="table-td-detail">{{ Qr.email_partner }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold table-td-dark">Telepon</td>
                                <td class="table-td-detail table-td-dark">{{ Qr.telp_partner }}</td>
                            </tr>
                            <tr>
                                <td class="table-td-detail font-semibold">Alamat</td>
                                <td class="table-td-detail">{{ Qr.alamat_partner }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <Modal :open-modal="openModal" modal-title="Update No. Resi" @closeModal="openModal = false">
            <form @submit.prevent="KirimPaket">
                <div class="mb-5">
                    <label for="nama" class="form-label-dashboard">Ekspedisi :</label>
                    <input class="form-input-dashboard" type="text" v-model="form.ekspedisi" placeholder="Ekspedisi">
                </div>
                <div>
                    <label for="no_tlp" class="form-label-dashboard">No. Resi :</label>
                    <input class="form-input-dashboard" type="text" v-model="form.no_resi" placeholder="Nomor Resi">
                </div>
                <div class="flex items-center justify-end space-x-2 font-medium mt-8 pb-5">
                    <button @click="openModal = false" class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </Modal>
    </AdminLayout>
</template>