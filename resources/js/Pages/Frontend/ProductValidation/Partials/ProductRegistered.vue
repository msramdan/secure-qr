<script setup>
import logo from '@src/images/validation/Frame 4112.jpg'
import Black from '@src/images/validation/Black.png'
import productImage from '@src/images/validation/Rectangle 442.jpg'
import successRate from '@src/images/validation/Group 4109.png'
import ValidationLayout from '@/Layouts/Frontend/ValidationLayout.vue'
import PengaduanModal from '@/Components/Frontend/Validation/Modal.vue'
import StarRating from 'vue-star-rating'
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const openModal = ref(false)
const modalRoyalti = ref(false)
const props = defineProps({
    product: Object,
    sosmed: Object,
    product_rate: Object,
    status: Boolean,
    loyalty: Boolean,
})
const rating = ref(0)
const statusRating = ref(props.status)
const statusLoyaty = ref(props.loyalty)
const allRating = ref(props.product_rate)
const SaveRating = () => {
    fetch(route('api.rating', props.product.serial_number), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Inertia': true
        },
        body: JSON.stringify({
            productRate: rating.value
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        allRating.value = data.rating
        openModal.value = true
        statusRating.value = true
    })
    .catch(error => {
        alert('There was a problem with the fetch operation:', error);
    });
}
const form = useForm({
    name: '',
    phone: '',
    nik: ''
});
const ClaimRoyalty = () => {
    fetch(route('api.claim.store', props.product.serial_number), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Inertia': true
        },
        body: JSON.stringify({
            name: form.name,
            phone: form.phone,
            nik: form.nik
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        modalRoyalti.value = false
        statusLoyaty.value = false
    })
    .catch(error => {
        alert('There was a problem with the fetch operation:', error);
    });
}
</script>

<template>
    <ValidationLayout>
        <template #logo>
            <img :src="`/storage/uploads/logos/` + product.logo_brand" alt="Unilever" class="mx-auto">
        </template>

        <template #jumbotron>
            <img :src="Black" class="mx-auto mb-4">
            <div class="text-center text-white">
                <div class="">Serial Number</div>
                <div class="font-semibold text-2xl">{{ product.serial_number }}</div>
            </div>
        </template>

        <div class="bg-[#F5FBF8] border border-[#52BD94] p-4 flex items-center rounded-xl mb-5">
            <svg class="mr-3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M0 8C0 12.42 3.58 16 8 16C12.42 16 16 12.42 16 8C16 3.58 12.42 0 8 0C3.58 0 0 3.58 0 8ZM11.29 5.29C11.47 5.11 11.72 5 12 5C12.55 5 13 5.45 13 6C13 6.28 12.89 6.53 12.71 6.71L7.71 11.71C7.53 11.89 7.28 12 7 12C6.72 12 6.47 11.89 6.29 11.71L3.29 8.71C3.11 8.53 3 8.28 3 8C3 7.45 3.45 7 4 7C4.28 7 4.53 7.11 4.71 7.29L7 9.59L11.29 5.29Z"
                    fill="#52BD94" />
            </svg>
            <div class="text-sm text-[#317159]">Produk terdaftar secara resmi</div>
        </div>

        <!-- Brand -->
        <div class="mb-10">
            <img :src="`/storage/uploads/photos/` + product.photo" class="w-full mb-5">
            <ul class="list-group">
                <li class="flex justify-between items-center py-1">
                    <span class="text-gray-500">Brand</span>
                    <span>{{ product.nama_brand }}</span>
                </li>
                <li class="flex justify-between items-center py-1">
                    <span class="text-gray-500">Nama Produk</span>
                    <span>{{ product.nama_produk }}</span>
                </li>
                <li class="flex justify-between items-center py-1">
                    <span class="text-gray-500">Nomor Produk</span>
                    <span>{{ product.bpom != 0 ? product.bpom : 0 }}</span>
                </li>
                <li class="flex justify-between items-center py-1">
                    <span class="text-gray-500">Rating Produk</span>
                    <div class="flex justify-between items-center">
                        <span class="mr-2">{{ allRating }}/5</span>
                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 12.3917L11.4583 14.4833C12.0917 14.8667 12.8667 14.3 12.7 13.5833L11.7833 9.65L14.8417 7C15.4 6.51666 15.1 5.6 14.3667 5.54167L10.3417 5.2L8.76667 1.48333C8.48333 0.808331 7.51667 0.808331 7.23333 1.48333L5.65833 5.19166L1.63333 5.53333C0.9 5.59166 0.599999 6.50833 1.15833 6.99166L4.21667 9.64166L3.3 13.575C3.13333 14.2917 3.90833 14.8583 4.54167 14.475L8 12.3917Z" fill="#FFBE40"/>
                        </svg>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Media Sosial -->
        <div class="mb-10" v-if="sosmed != ''">
            <div class="font-bold text-center mb-5">Terhubung via akun official</div>
            <ul class="list-group" v-for="link,index in sosmed" :key="index">
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Instagram'" target="_blank">
                        <svg class="mr-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 10C13 10.5933 12.8241 11.1734 12.4944 11.6667C12.1648 12.1601 11.6962 12.5446 11.1481 12.7716C10.5999 12.9987 9.99667 13.0581 9.41473 12.9424C8.83279 12.8266 8.29824 12.5409 7.87868 12.1213C7.45912 11.7018 7.1734 11.1672 7.05764 10.5853C6.94189 10.0033 7.0013 9.40013 7.22836 8.85195C7.45542 8.30377 7.83994 7.83524 8.33329 7.50559C8.82664 7.17595 9.40666 7 10 7C10.7949 7.00247 11.5565 7.31934 12.1186 7.88141C12.6807 8.44349 12.9975 9.20511 13 10ZM19.375 5.875V14.125C19.375 15.5174 18.8219 16.8527 17.8373 17.8373C16.8527 18.8219 15.5174 19.375 14.125 19.375H5.875C4.48261 19.375 3.14726 18.8219 2.16269 17.8373C1.17812 16.8527 0.625 15.5174 0.625 14.125V5.875C0.625 4.48261 1.17812 3.14726 2.16269 2.16269C3.14726 1.17812 4.48261 0.625 5.875 0.625H14.125C15.5174 0.625 16.8527 1.17812 17.8373 2.16269C18.8219 3.14726 19.375 4.48261 19.375 5.875ZM14.5 10C14.5 9.10998 14.2361 8.23995 13.7416 7.49993C13.2471 6.75991 12.5443 6.18314 11.7221 5.84254C10.8998 5.50195 9.99501 5.41283 9.12209 5.58647C8.24918 5.7601 7.44736 6.18868 6.81802 6.81802C6.18868 7.44736 5.7601 8.24918 5.58647 9.12209C5.41283 9.99501 5.50195 10.8998 5.84254 11.7221C6.18314 12.5443 6.75991 13.2471 7.49993 13.7416C8.23995 14.2361 9.10998 14.5 10 14.5C11.1935 14.5 12.3381 14.0259 13.182 13.182C14.0259 12.3381 14.5 11.1935 14.5 10ZM16 5.125C16 4.9025 15.934 4.68499 15.8104 4.49998C15.6868 4.31498 15.5111 4.17078 15.3055 4.08564C15.1 4.00049 14.8738 3.97821 14.6555 4.02162C14.4373 4.06502 14.2368 4.17217 14.0795 4.3295C13.9222 4.48684 13.815 4.68729 13.7716 4.90552C13.7282 5.12375 13.7505 5.34995 13.8356 5.55552C13.9208 5.76109 14.065 5.93679 14.25 6.0604C14.435 6.18402 14.6525 6.25 14.875 6.25C15.1734 6.25 15.4595 6.13147 15.6705 5.9205C15.8815 5.70952 16 5.42337 16 5.125Z" fill="#827AF3"/>
                    </svg>
                    <span class="text-[#827AF3]">Instagram</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Facebook'" target="_blank">
                        <svg class="mr-3" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 10C20 4.48 15.52 0 10 0C4.48 0 0 4.48 0 10C0 14.84 3.44 18.87 8 19.8V13H6V10H8V7.5C8 5.57 9.57 4 11.5 4H14V7H12C11.45 7 11 7.45 11 8V10H14V13H11V19.95C16.05 19.45 20 15.19 20 10Z" fill="#827AF3"/>
                    </svg>
                    <span class="text-[#827AF3]">Facebook</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Twitter'" target="_blank">
                        <svg class="mr-3" width="20" height="20" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.46 2C20.69 2.35 19.86 2.58 19 2.69C19.88 2.16 20.56 1.32 20.88 0.31C20.05 0.81 19.13 1.16 18.16 1.36C17.37 0.5 16.26 0 15 0C12.65 0 10.73 1.92 10.73 4.29C10.73 4.63 10.77 4.96 10.84 5.27C7.28 5.09 4.11 3.38 2 0.79C1.63 1.42 1.42 2.16 1.42 2.94C1.42 4.43 2.17 5.75 3.33 6.5C2.62 6.5 1.96 6.3 1.38 6V6.03C1.38 8.11 2.86 9.85 4.82 10.24C4.19073 10.4122 3.5301 10.4362 2.89 10.31C3.16161 11.1625 3.69354 11.9084 4.41102 12.4429C5.1285 12.9775 5.99545 13.2737 6.89 13.29C5.37363 14.4904 3.494 15.1393 1.56 15.13C1.22 15.13 0.880001 15.11 0.540001 15.07C2.44 16.29 4.7 17 7.12 17C15 17 19.33 10.46 19.33 4.79C19.33 4.6 19.33 4.42 19.32 4.23C20.16 3.63 20.88 2.87 21.46 2Z" fill="#827AF3"/>
                    </svg>
                    <span class="text-[#827AF3]">Twitter</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Linkedin'" target="_blank">
                        <svg class="mr-3" width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 0C16.5304 0 17.0391 0.210714 17.4142 0.585786C17.7893 0.960859 18 1.46957 18 2V16C18 16.5304 17.7893 17.0391 17.4142 17.4142C17.0391 17.7893 16.5304 18 16 18H2C1.46957 18 0.960859 17.7893 0.585786 17.4142C0.210714 17.0391 0 16.5304 0 16V2C0 1.46957 0.210714 0.960859 0.585786 0.585786C0.960859 0.210714 1.46957 0 2 0H16ZM15.5 15.5V10.2C15.5 9.33539 15.1565 8.5062 14.5452 7.89483C13.9338 7.28346 13.1046 6.94 12.24 6.94C11.39 6.94 10.4 7.46 9.92 8.24V7.13H7.13V15.5H9.92V10.57C9.92 9.8 10.54 9.17 11.31 9.17C11.6813 9.17 12.0374 9.3175 12.2999 9.58005C12.5625 9.8426 12.71 10.1987 12.71 10.57V15.5H15.5ZM3.88 5.56C4.32556 5.56 4.75288 5.383 5.06794 5.06794C5.383 4.75288 5.56 4.32556 5.56 3.88C5.56 2.95 4.81 2.19 3.88 2.19C3.43178 2.19 3.00193 2.36805 2.68499 2.68499C2.36805 3.00193 2.19 3.43178 2.19 3.88C2.19 4.81 2.95 5.56 3.88 5.56ZM5.27 15.5V7.13H2.5V15.5H5.27Z" fill="#827AF3"/>
                    </svg>
                    <span class="text-[#827AF3]">Linkedin</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Tiktok'" target="_blank">
                        <svg class="mr-3" width="20" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.1752 4.27693C15.0402 4.20711 14.9088 4.13058 14.7815 4.04762C14.4115 3.80295 14.0722 3.51469 13.7709 3.18903C13.0163 2.326 12.7346 1.45053 12.6315 0.838144H12.635C12.5488 0.328858 12.5844 0 12.5906 0H9.15536V13.2814C9.15536 13.4592 9.15536 13.6361 9.14825 13.8103C9.14825 13.8316 9.14558 13.8511 9.1447 13.8751C9.1447 13.884 9.1447 13.8947 9.14203 13.9045V13.9125C9.10595 14.3889 8.95334 14.8491 8.69761 15.2527C8.44188 15.6563 8.09089 15.9909 7.6755 16.2269C7.24214 16.4735 6.75199 16.6027 6.25341 16.602C4.65356 16.602 3.3559 15.2972 3.3559 13.6858C3.3559 12.0735 4.65356 10.7688 6.25341 10.7688C6.55649 10.7688 6.8578 10.8168 7.14577 10.911L7.15022 7.41264C6.27564 7.2998 5.38718 7.3695 4.54089 7.61733C3.69461 7.86515 2.9089 8.28573 2.23334 8.8525C1.64127 9.36671 1.14348 9.98031 0.76237 10.6657C0.617494 10.9154 0.0699903 11.9207 0.00421868 13.5507C-0.0375552 14.4751 0.240641 15.435 0.373073 15.8305V15.8394C0.455732 16.0723 0.779257 16.8686 1.30543 17.5397C1.72974 18.0783 2.23108 18.5515 2.79329 18.944V18.9351L2.80129 18.944C4.46336 20.0728 6.30763 19.999 6.30763 19.999C6.62671 19.9857 7.69594 19.999 8.91005 19.424C10.2566 18.7858 11.0227 17.8357 11.0227 17.8357C11.5126 17.2678 11.9021 16.6207 12.1746 15.9221C12.4857 15.1044 12.5888 14.1249 12.5888 13.7338V6.68648C12.6306 6.71137 13.1861 7.07845 13.1861 7.07845C13.1861 7.07845 13.986 7.59129 15.233 7.92459C16.1272 8.1619 17.3333 8.21256 17.3333 8.21256V4.80222C16.9111 4.84843 16.0534 4.71511 15.1744 4.27782L15.1752 4.27693Z" fill="#827AF3"/>
                    </svg>
                    <span class="text-[#827AF3]">TikTok</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Youtube'" target="_blank">
                    <img :src="`/social_icon/youtube.png`" alt="Youtube" width="20" height="20" class="mr-3">
                    <span class="text-[#827AF3]">Youtube</span>
                </a>
            </ul>

            <div class="font-bold text-center mb-5">Dapatkan produk di official store</div>
            <ul class="list-group" v-for="link,index in sosmed" :key="index">
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'TiktokShop'" target="_blank">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEieV7emUBzS46dGZ2s-CAd6AAUF3bPtRtgBjzfhKYz6in15PMBnrR8T0t-baXpfuX3Rdzr0hzx3HQZ8GATo8zPXz5epkGeJWezrpozmul0fmE742QiVPLaJUG0UObC4uE0RKXJkzz4uKMSUJOfD3pzhQNV1xKYGMkRrSnPIZO4QkVak8cXjy9qvkdpO/s1600/download.png" alt="tiktok_shop" width="30" height="30" class="mr-3">
                    <span class="text-[#827AF3]">Tiktok Shop</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Lazada'" target="_blank">
                    <img src="https://id-test-11.slatic.net/p/d2a68971c70bebb12edf7dc6e82a978c.png" alt="lazada" width="28" height="28" class="mr-3">
                    <span class="text-[#827AF3]">Lazada</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Shopee'" target="_blank">
                    <img src="https://www.pngmart.com/files/12/Shopee-Logo-Transparent-Background.png" alt="shopee" width="25" height="25" class="mr-3">
                    <span class="text-[#827AF3]">Shopee</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Tokopedia'" target="_blank">
                    <img src="https://seeklogo.com/images/T/tokopedia-logo-7AC053EC2E-seeklogo.com.png" alt="tokopedia" width="30" height="30" class="mr-3">
                    <span class="text-[#827AF3]">Tokopedia</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Buka Lapak'" target="_blank">
                    <img src="https://www.iconlogovector.com/uploads/images/2022/01/bukalapak3.png" alt="buka_lapak" width="20" height="20" class="mr-3">
                    <span class="text-[#827AF3]">Buka Lapak</span>
                </a>
            </ul>

            <div class="font-bold text-center mb-5">Terhubung dengan Customer Care</div>
            <ul class="list-group" v-for="link,index in sosmed" :key="index">
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Whatsapp'" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="whatsapp" width="20" height="20" class="mr-3">
                    <span class="text-[#827AF3]">Whatsapp</span>
                </a>
                <a :href="link.link_sosmed" class="flex items-center px-5 py-3 my-2.5 border rounded" v-if="link.name == 'Telepon'" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/9073/9073069.png" alt="telepon" width="20" height="20" class="mr-3">
                    <span class="text-[#827AF3]">Telepon</span>
                </a>
            </ul>
        </div>

        <!-- Beri Rating -->
        <div>
            <form @submit.prevent="SaveRating" v-if="statusRating == false">
                <div class="text-gray-500 text-center mb-4">Yuk, beli produk kami dan beri rating terbaik</div>
                <div class="flex justify-center space-x-3 mb-8">
                    <star-rating v-model:rating="rating" :star-size="30" active-color="#FFBE40" :rounded-corners="true" padding="2" :show-rating="false"/>
                </div>
                <button type="submit" class="btn-validation">Beri Rating</button>
            </form>
            <div class="text-gray-500 text-center mb-4" v-else>Terimakasih, anda sudah melakukan rating pada produk kami!</div>
        </div>

        <!-- Loyalti Program jika ada -->
        <!-- <div v-if="statusLoyaty == true">
            <button @click="modalRoyalti = true" class="btn-validation mt-3">Claim Reward</button>
        </div> -->

        <template #modal>
            <PengaduanModal :open-modal="openModal" @closeModal="openModal = false">
                <img :src="successRate" class="mx-auto mb-5">
                <div class="text-center mb-10">Berhasil memberi rating produk</div>
                <button @click="openModal = false" class="btn-secondary-validation">Oke</button>
            </PengaduanModal>

            <!-- <PengaduanModal :open-modal="modalRoyalti" @closeModal="modalRoyalti = false">
                <img :src="successRate" class="mx-auto mb-5">
                <form class="mb-10" @submit.prevent="ClaimRoyalty">
                    <div class="mb-3">
                        <label for="name" class="label-validation">Nama Lengkap</label>
                        <input class="form-input-validation" type="text" v-model="form.name" id="name" placeholder="Nama lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="label-validation">No. Telepon</label>
                        <input class="form-input-validation" type="text" v-model="form.phone" id="phone" placeholder="Nomor telepon">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="label-validation">NIK</label>
                        <input class="form-input-validation" type="text" v-model="form.nik" id="nik" minlength="16" maxlength="16" placeholder="Nomor Induk Kependudukan">
                    </div>
                    <button type="submit" class="btn-secondary-validation">Claim</button>
                </form>
            </PengaduanModal> -->
        </template>
    </ValidationLayout>
</template>
