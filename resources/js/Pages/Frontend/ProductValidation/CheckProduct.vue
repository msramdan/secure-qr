<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import Black from '@src/images/validation/Black.png'
import labelin from '@src/images/validation/image 34.png'
import ValidationLayout from '@/Layouts/Frontend/ValidationLayout.vue'
import PanduanModal from '@/Components/Frontend/Validation/Modal.vue'
import { ref, onMounted, reactive, getCurrentInstance } from 'vue'
import { Inertia } from '@inertiajs/inertia';

const openModal = ref(false)
const props = defineProps({
    brandLogo: Object,
    brandVideo: Object,
    sn: String,
    apiKey: String,
    errors: Object,
})
const form = useForm({
    serial_number: props.sn,
    wa_number: '',
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
    form.post(route('wa-scan-notification'))
}
onMounted(() => {
  const inputs = document.querySelectorAll('.form-input-pin')
  
  inputs.forEach((input, index) => {
    input.addEventListener('input', (event) => {
      const inputVal = event.target.value
      const maxLength = event.target.maxLength
      
      if (inputVal.length === maxLength) {
        if (index < inputs.length - 1) {
          inputs[index + 1].focus()
        }
      }
    })
    
    input.addEventListener('keydown', (event) => {
      const keyCode = event.keyCode || event.which
      
      if (keyCode === 8 && !event.target.value) {
        if (index > 0) {
          inputs[index - 1].focus()
        }
      }
    })
  })
})
</script>

<template>
    <Head title="Cek Produk"/>
    <ValidationLayout>
        <link href="https://unpkg.com/@primer/css@^20.2.4/dist/primer.css" rel="stylesheet" />
        <template #logo>
            <div v-if="brandLogo == null || brandLogo ==''" class="mx-auto text-center">Not found</div>
            <img v-else :src="`/storage/uploads/logos/` + brandLogo.logo" :alt="brandLogo.logo" class="mx-auto">
        </template>

        <template #jumbotron>
            <img :src="Black" class="mx-auto mb-4">
            <div class="text-center text-white">
                <div class="text-sm mb-1">Serial Number</div>
                <div class="font-semibold text-2xl">{{ sn }}</div>
            </div>
        </template>
        <div class="flex justify-center items-center" v-if="brandVideo != null || brandVideo ==''">
            <video id="video" width="300" height="250" autoplay="" loop="" name="media" muted="">
                    <source :src="`/storage/uploads/videos/` + brandVideo.video" type="video/mp4">
                    Browser anda tidak suport untuk menampilkan video.
            </video>
        </div>
        <form @submit.prevent="FormSubmit">
        <div class="mb-5">
            <div class="fs-6 text-center">Masukkan Nomor Whatsapp</div>
            <div v-if="Object.keys(form.errors).length > 0" class="flash mt-3 flash-error">
                <!-- <%= octicon "stop" %> -->
                <svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M4.47.22A.75.75 0 015 0h6a.75.75 0 01.53.22l4.25 4.25c.141.14.22.331.22.53v6a.75.75 0 01-.22.53l-4.25 4.25A.75.75 0 0111 16H5a.75.75 0 01-.53-.22L.22 11.53A.75.75 0 010 11V5a.75.75 0 01.22-.53L4.47.22zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5H5.31zM8 4a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 018 4zm0 8a1 1 0 100-2 1 1 0 000 2z"></path></svg>
                Gagal! {{ form.errors[Object.keys(form.errors)[0]] }}.
            </div>

            <div class="flex justify-center my-4 px-3" v-if="!$page.props.flash.success">
                <input type="number" name="no_wa" id="no_wa" placeholder="No Whatsapp" class="form-control rounded" autocomplete="off" v-model.number="form.wa_number" style="outline: 1px solid #DDD; border: 0px; width: 100%;">
            </div>

            <div v-if="$page.props.flash.success" class="flash mt-3 flash-success">
                <!-- <%= octicon "stop" %> -->
                <svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                Berhasil! {{ $page.props.flash.success }}.
            </div>

            </div>
            <button class="btn-validation mt-2 mb-10" v-if="!$page.props.flash.success">Dapatkan Link Produk</button>
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
