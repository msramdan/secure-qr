<script setup>
import logo from '@src/images/validation/Frame 4112.jpg'
import jumbotron from '@src/images/validation/Group 4110.png'
import productImage from '@src/images/validation/Rectangle 442.jpg'
import ValidationLayout from '@/Layouts/Frontend/ValidationLayout.vue'
import PengaduanModal from '@/Components/Frontend/Validation/Modal.vue'
import { ref } from 'vue'

const openModal = ref(false)
</script>

<template>
    <ValidationLayout>
        <template #logo>
            <img :src="logo" alt="Unilever" class="mx-auto">
        </template>

        <template #jumbotron>
            <img :src="jumbotron" class="mx-auto mb-4">
            <div class="text-center text-white">
                <div class="font-semibold text-2xl mb-1">Oops!...</div>
                <div class="text-sm">Nomor Seri dan Produk <br> terduga mengalami terduplikasi</div>
            </div>
        </template>

        <!-- Alert -->
        <div class="bg-[#FDF4F4] border border-[#DB2424] p-4 flex rounded-xl mb-10">
            <svg class="flex-none mt-1.5 mr-3" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00001 0.00499725C3.58277 0.00499725 0.00500488 3.58276 0.00500488 8C0.00500488 12.4172 3.58277 15.995 8.00001 15.995C12.4172 15.995 15.995 12.4172 15.995 8C15.995 3.58276 12.4172 0.00499725 8.00001 0.00499725ZM7.00063 12.9969V10.9981H8.99938V12.9969H7.00063ZM7.00063 3.00312V9.99875H8.99938V3.00312H7.00063Z" fill="#DB2424"/>
            </svg>
            <div class="text-sm text-[#A73636]">Mohon maaf nomor seri dan produk terduga mengalami duplikasi. Waspada produk palsu atau tiruan!</div>
        </div>

        <!-- Tombol Pengaduan -->
        <div>
            <button @click="openModal = true" class="btn-validation mb-4">Pengaduan Produk</button>
            <button class="btn-secondary-validation">Hubungi Whatsapp</button>
        </div>

        <template #bottom-content>
            <a href="#" class="text-center text-purple-validation py-10">Kembali</a>
        </template>

        <!-- Modal Pengaduan -->
        <template #modal>
            <PengaduanModal
                :open-modal="openModal"
                modal-title="Formulir Pengaduan Perlindungan Konsumen"
                @closeModal="openModal = false"
            >
                <form class="mb-10">
                    <div class="mb-3">
                        <label for="nama" class="label-validation">Nama Lengkap</label>
                        <input class="form-input-validation" type="text" name="nama" placeholder="Nama lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="label-validation">No. Tlp</label>
                        <input class="form-input-validation" type="text" name="no_tlp" placeholder="Nomor telepon">
                    </div>
                    <div class="mb-3">
                        <label for="pengaduan" class="label-validation">Pengaduan</label>
                        <textarea class="form-input-validation" name="pengaduan" id="pengaduan" rows="3" placeholder="Pengaduan kronologis"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lampiran" class="label-validation">Lampiran Pendukung</label>
                        <label for="lampiran" class="label-validation cursor-pointer">
                            <div class="flex border border-gray-300 rounded-md">
                                <div class="grow text-gray-400 px-4 py-2">Select or drag file</div>
                                <div class="flex-none text-gray-500 border-l border-gray-300 px-4 py-2">Select file</div>
                            </div>
                        </label>
                        <input class="hidden" type="file" name="lampiran" id="lampiran">
                    </div>
                </form>
                <button @click="openModal = false" class="btn-validation">Kirim Laporan</button>
            </PengaduanModal>
        </template>
    </ValidationLayout>
</template>
