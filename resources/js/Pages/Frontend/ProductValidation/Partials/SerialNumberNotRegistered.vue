<script setup>
// import logo from '@src/images/validation/Frame 4112.jpg'
import jumbotron from '@src/images/validation/Group 4108.png'
import ValidationLayout from '@/Layouts/Frontend/ValidationLayout.vue'
import PengaduanModal from '@/Components/Frontend/Validation/Modal.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios'

const openModal = ref(false)
const props = defineProps({sn:String})
const HubungiWhatsapp = (url) => {
    window.open(url,'_blank')
};
const goBack = () => { 
    window.history.back();
}
const form= useForm({
    nama_lengkap: '',
    no_telepon: '',
    kronologi: '',
    lampiran: '',
    serial_number: props.sn
});

const FormSubmit = () => {
const formData = new FormData();
formData.append('nama_lengkap', form.nama_lengkap);
formData.append('no_telepon', form.no_telepon);
formData.append('kronologi', form.kronologi);
formData.append('lampiran', form.lampiran);
formData.append('serial_number', form.serial_number);

axios.post(route('api.report'), formData, {
headers: {
    'Content-Type': 'multipart/form-data'
}
})
.then(() => {
    alert('Terimakasih atas laporan anda!')
    openModal.value = false
})
.catch(() => {
    alert('Gagaln, silahkan coba laporkan ke whatsapp admin')
});
};
</script>

<template>
    <ValidationLayout>
        <!-- <template #logo>
            <img :src="logo" alt="Unilever" class="mx-auto">
        </template> -->

        <template #jumbotron>
            <img :src="jumbotron" class="mx-auto mb-4">
            <div class="text-center text-white">
                <div class="font-semibold text-2xl mb-1">Oops!...</div>
                <div class="text-sm">Nomor Seri Tidak Terdaftar</div>
            </div>
        </template>

        <!-- Alert -->
        <div class="bg-[#FDF4F4] border border-[#DB2424] p-4 flex rounded-xl mb-10">
            <svg class="flex-none mt-1.5 mr-3" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00001 0.00499725C3.58277 0.00499725 0.00500488 3.58276 0.00500488 8C0.00500488 12.4172 3.58277 15.995 8.00001 15.995C12.4172 15.995 15.995 12.4172 15.995 8C15.995 3.58276 12.4172 0.00499725 8.00001 0.00499725ZM7.00063 12.9969V10.9981H8.99938V12.9969H7.00063ZM7.00063 3.00312V9.99875H8.99938V3.00312H7.00063Z" fill="#DB2424"/>
            </svg>
            <div class="text-sm text-[#A73636]">Mohon maaf nomor seri yang Anda cari tidak terdaftar pada produk manapun saat ini. Waspada produk palsu atau tiruan!</div>
        </div>

        <!-- Tombol Pengaduan -->
        <div>
            <button @click="openModal = true" class="btn-validation mb-4">Pengaduan Produk</button>
            <button @click.prevent="HubungiWhatsapp('https://wa.me/6281299903331?text=Silahkan%20ajukan%20pengaduan%20anda%20tentang%20serial%20number%20' + sn)" class="btn-secondary-validation">Hubungi Whatsapp</button>
        </div>

        <template #bottom-content>
            <a href="#" @click.prevent="goBack" class="text-center text-purple-validation py-10">Kembali</a>
        </template>

        <!-- Modal Pengaduan -->
        <template #modal>
            <PengaduanModal
                :open-modal="openModal"
                modal-title="Formulir Pengaduan Perlindungan Konsumen"
                @closeModal="openModal = false"
            >
                <form class="mb-10" @submit.prevent="FormSubmit">
                    <div class="mb-3">
                        <label for="nama" class="label-validation">Nama Lengkap</label>
                        <input class="form-input-validation" type="text" v-model="form.nama_lengkap" placeholder="Nama lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="label-validation">No. Tlp</label>
                        <input class="form-input-validation" type="text" v-model="form.no_telepon" placeholder="Nomor telepon">
                    </div>
                    <div class="mb-3">
                        <label for="pengaduan" class="label-validation">Kronologi</label>
                        <textarea class="form-input-validation" v-model="form.kronologi" id="Kronologi" rows="3" placeholder="Tulis pengaduan anda di sini!"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="label-validation">Lampiran Pendukung</label>
                        <label for="lampiran" class="label-validation cursor-pointer">
                            <div class="flex border border-gray-300 rounded-md">
                                <div class="grow text-gray-400 px-4 py-2">{{ form.lampiran != '' ? form.lampiran.name : 'Select or drag file' }}</div>
                                <div class="flex-none text-gray-500 border-l border-gray-300 px-4 py-2">Select file</div>
                            </div>
                        </label>
                        <input class="hidden" type="file" @input="form.lampiran = $event.target.files[0]" id="lampiran">
                    </div>
                    <button type="submit" class="btn-validation">Kirim Laporan</button>
                </form>
            </PengaduanModal>
        </template>
    </ValidationLayout>
</template>
