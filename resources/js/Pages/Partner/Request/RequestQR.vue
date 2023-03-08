<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue';
import TableAction from '@/Components/Partner/TableAction.vue';
import Datatable from '@/Components/Partner/Datatable.vue';
import ActionIcon from '@/Components/Admin/ActionIcon.vue';
import Modal from '@/Components/Modal.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const openModal = ref(false)
const selectId = ref('')
const props = defineProps({
    requestQr: Object,
    filters: Object
})
const formUpload = useForm({
    bukti_pembayaran: '',
    id: ''
})

const submitUpload = (e) => {
    formUpload.id = e
    formUpload.post(route('partner.request.upload', e));
    openModal.value = false
}
</script>

<template>
    <Head title="Data Request QR"/>

    <PartnerLayout>
        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="basis-3/4">
                <div class="card-dashboard">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="card-title-dashboard mb-0">Data Request QR</h2>
                    </div>

                    <Datatable  :paginationLinks="requestQr" :filters="filters">
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
                                <tr v-for="req,i in requestQr.data" :key="i" class="odd:bg-odd">
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ ++i }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.code }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.product }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.type }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.qty }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.amount_price }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">{{ req.status }}</td>
                                    <td class="table-td" :class="{ 'table-td-dark': req.id % 2 != 0 }">
                                        <TableAction>
                                            <Link :href="route('partner.request.show', req.id)">
                                                <ActionIcon>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </ActionIcon>
                                            </Link>
                                            <a  v-if="req.is_generate == 'Sudah Generate'" :href="route('partner.export.Qr', req.id)" target="_blank">
                                                <ActionIcon>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </ActionIcon>
                                            </a>
                                            <button  v-if="!req.bukti_bayar" type="button" @click="openModal = true; selectId = req.id">
                                                <div class="bg-[#DDDAF2] hover:bg-opacity-75 flex items-center justify-center w-8 h-8 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-purple-1100 w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </div>
                                            </button>
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

        <Modal :open-modal="openModal" :select-id="selectId" modal-title="Upload Bukti Bayar" @closeModal="openModal = false">
            <form @submit.prevent="submitUpload(selectId)">
                <div class="mb-5">
                    <label for="photo" class="form-label-dashboard">Bukti Bayar :</label>
                    <label for="photo" class="block mb-2 cursor-pointer">
                        <div class="flex border border-gray-300 rounded-lg">
                            <div class="grow text-gray-400 px-4 py-2">
                                {{ formUpload.bukti_pembayaran != '' ? formUpload.bukti_pembayaran.name : 'Choose file' }}
                            </div>
                            <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                        </div>
                    </label>
                    <input type="file" @input="formUpload.bukti_pembayaran = $event.target.files[0]" id="photo" class="hidden"/>
                    <input type="hidden" :value="selectId"/>
                    <InputError :message="formUpload.errors.bukti_pembayaran" />
                </div>
                <div class="flex items-center justify-end space-x-2 font-medium mt-8 pb-5">
                    <button @click="openModal = false" class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Batal</button>
                    <button type="submit" class="btn-primary">Submit</button>
                </div>
            </form>
        </Modal>
    </PartnerLayout>
</template>
