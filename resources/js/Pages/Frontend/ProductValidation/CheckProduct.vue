<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import logo from '@src/images/validation/Frame 4112.jpg'
import Black from '@src/images/validation/Black.png'
import labelin from '@src/images/validation/image 34.png'
import ValidationLayout from '@/Layouts/Frontend/ValidationLayout.vue'
import PanduanModal from '@/Components/Frontend/Validation/Modal.vue'
import { ref, onMounted, reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia';

const openModal = ref(false)
const props = defineProps({
    qr: Object,
    sn: String,
    apiKey: String
})
const form = useForm({
    serial_number: props.sn,
    one:'',
    two:'',
    three:'',
    four:'',
    five:'',
    six: '',
    latitude: '',
    longitude: '',
    kota: ''
})

const state = reactive({
    latitude: null,
    longitude: null,
    city: null,
});

const getLocation = () => {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            state.latitude = position.coords.latitude;
            state.longitude = position.coords.longitude;
            const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${state.latitude},${state.longitude}&key=${props.apiKey}`;
            fetch(url)
            .then(response => response.json())
            .then(data => {
                for (let i = 0; i < data.results[0].address_components.length; i++) {
                const component = data.results[0].address_components[i];
                if (component.types.includes('locality')) {
                    state.city = component.long_name;
                    break;
                } else if (component.types.includes('administrative_area_level_2')) {
                    state.city = component.long_name;
                    break;
                }
                }
            })
            .catch(error => {
                alert(error);
            });
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
};

onMounted(() => {
    getLocation();
});
const FormSubmit = () => {
    form.latitude = state.latitude;
    form.longitude = state.longitude;
    form.kota = state.city;
    form.post(route('validation'))
}
</script>

<template>
    <Head title="Cek Produk"/>

    <ValidationLayout>
        <template #logo>
            <img :src="logo" alt="Unilever" class="mx-auto">
        </template>

        <template #jumbotron>
            <img :src="Black" class="mx-auto mb-4">
            <div class="text-center text-white">
                <div class="text-sm mb-1">Serial Number</div>
                <div class="font-semibold text-2xl">{{ sn }}</div>
            </div>
        </template>

        <form @submit.prevent="FormSubmit">
        <div class="mb-5">
            <div class="fs-6 text-center">Masukkan Pin</div>
            <div class="flex justify-center my-4">
                    <div class="flex space-x-1">
                        <input ref="one" type="text" v-model.number="form.one" maxlength="1" class="form-input-pin" placeholder="_">
                        <input ref="two" type="text" v-model.number="form.two" maxlength="1" class="form-input-pin" placeholder="_">
                        <input ref="three" type="text" v-model.number="form.three" maxlength="1" class="form-input-pin" placeholder="_">
                        <input ref="four" type="text" v-model.number="form.four" maxlength="1" class="form-input-pin" placeholder="_">
                        <input ref="five" type="text" v-model.number="form.five" maxlength="1" class="form-input-pin" placeholder="_">
                        <input ref="six" type="text" v-model.number="form.six" maxlength="1" class="form-input-pin" placeholder="_">
                    </div>
                </div>
                <div class="fs-6 text-center text-secondary-validation">*Pin terdapat pada label QR</div>
            </div>
            <button class="btn-validation my-10">Cek Produk</button>
        </form>

        <div @click="openModal = true" class="flex items-center justify-center cursor-pointer">
            <svg class="w-3.5 h-3.5 mr-2" viewBox="0 0 12 12" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6 0C2.685 0 0 2.685 0 6C0 9.315 2.685 12 6 12C9.315 12 12 9.315 12 6C12 2.685 9.315 0 6 0ZM6.75 2.25V3.75H5.25V2.25H6.75ZM4.5 9V9.75H7.5V9H6.75V4.5H4.5V5.25H5.25V9H4.5Z"
                    fill="#8C8CA2" />
            </svg>
            <div class="text-secondary-validation">Panduan Penggunaan</div>
        </div>

        <template #bottom-content>
            <div class="flex items-center justify-center py-10">
                <div class="text-secondary-validation mr-2">Didukung oleh</div>
                <img :src="labelin" alt="Labelin">
            </div>
        </template>

        <template #modal>
            <PanduanModal :open-modal="openModal" @closeModal="openModal = false">
                <div class="font-semibold text-lg text-center mb-10">Panduan Penggunaan</div>
                <ul class="list-group mb-10">
                    <li class="flex space-x-3 mb-3">
                        <div class="badge">1</div>
                        <div>Temukan QR code pada kemasan produk Anda</div>
                    </li>
                    <li class="flex space-x-3 mb-3">
                        <div class="badge">2</div>
                        <div>Scan menggunakan QR code Reader pada aplikasi atau Pindai dengan kamera ponsel Anda</div>
                    </li>
                    <li class="flex space-x-3 mb-3">
                        <div class="badge">3</div>
                        <div>Masukin 6 digit PIN yang terletak pada label produk, lalu cek produk.</div>
                    </li>
                </ul>
                <button @click="openModal = false" class="btn-secondary-validation">Oke</button>
            </PanduanModal>
        </template>
    </ValidationLayout>
</template>

<style scoped>
.form-input-pin {
    @apply w-9 border border-gray-300 text-center rounded placeholder-gray-400 focus:outline-none;
}

.badge {
    @apply flex-none bg-[#EBF0FF] flex items-center justify-center w-5 h-5 rounded-md mt-1 font-bold text-sm text-[#3366FF];
}
</style>
