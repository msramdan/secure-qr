<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue'
import Modal from '@/Components/Modal.vue'

const openMenu = () => {
    const menu = document.getElementById('menu')
    if (menu.style.maxHeight) {
        menu.style.maxHeight = null;
    } else {
        menu.style.maxHeight = menu.scrollHeight + 'px';
    }
}

const openVideoModal = () => {
    const modal = document.getElementById('video-modal')
    modal.classList.toggle('hidden')
}

const scrollTopButton = ref(null);

const handleScroll = () => {
    const scrollBtn = scrollTopButton.value;

    if (window.scrollY > 0) {
        scrollBtn.classList.remove('hidden');
    } else {
        scrollBtn.classList.add('hidden');
    }
}

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

onMounted(() => {
    let acc = document.getElementsByClassName('accordion');
    let i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener('click', function () {
            let panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        });
    }

    window.addEventListener('scroll', handleScroll);
})

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
})
</script>

<template>
    <div>
        <!-- Header -->
        <div class="sticky top-0 bg-white border-b py-4 lg:py-6 shadow-sm z-50">
            <nav class="landing-nav">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center justify-between">
                        <img src="@src/images/landing/Labelin-Logo.png" alt="Logo" class="w-36">
                        <button type="button" @click="openMenu" class="lg:hidden focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="fill-secondary hover:fill-gray-900 w-6 h-6">
                                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm8.25 5.25a.75.75 0 01.75-.75h8.25a.75.75 0 010 1.5H12a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <div id="menu" class="menu">
                        <ul class="flex flex-col lg:flex-row lg:space-x-10 space-y-3 lg:space-y-0 font-medium text-gray-600 pt-6 lg:pt-0">
                            <li class="active">
                                <a href="#">Beranda</a>
                            </li>
                            <li>
                                <a href="#">Produk</a>
                            </li>
                            <li>
                                <a href="#">API Integrasi</a>
                            </li>
                            <li>
                                <a href="#">Tentang</a>
                            </li>
                            <li>
                                <a href="#">Kontak</a>
                            </li>
                            <li>
                                <a href="#">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Lindungi Produk Anda -->
        <section class="landing-section">
            <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between space-y-reverse space-y-10 md:space-y-0">
                <div class="md:basis-5/12">
                    <div class="mb-16">
                        <h1 class="landing-h1">Lindungi Produk Anda <br> Secara Digital</h1>
                        <p class="landing-p">Securetag memudahkan Anda untuk melindungi merek produk asli, sehingga terbebas dari maraknya peredaran barang palsu. Mari mulai berikan produk maksimal kepada pelanggan Anda secara digital.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
                        <button class="landing-btn-primary">Konsultasi Sekarang</button>
                        <button @click="openVideoModal" class="landing-btn-light">
                            <div class="flex items-center justify-center md:justify-start space-x-3">
                                <div>Tentang Kami</div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm14.024-.983a1.125 1.125 0 010 1.966l-5.603 3.113A1.125 1.125 0 019 15.113V8.887c0-.857.921-1.4 1.671-.983l5.603 3.113z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="md:basis-6/12">
                    <img src="@src/images/landing/SecureTag.png" alt="SecureTag" class="w-full">
                </div>
            </div>
        </section>

        <!-- Modal Video Labelin -->
        <div id="video-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50" @click="openVideoModal">
            <section class="landing-section">
                <div class="flex items-center justify-center h-full">
                    <div class="bg-white p-4 md:p-8 rounded-2xl w-full md:w-4/5" @click.stop>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="landing-h3 mb-0">SecureTag - Labelin.co</h3>
                            <button type="button" class="focus:outline-none" @click="openVideoModal">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-secondary hover:text-gray-900 w-6 h-6">
                                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <video class="w-full" controls>
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            <source src="https://www.w3schools.com/html/mov_bbb.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </section>
        </div>

        <!-- Autentikasi Digital Berbasis Cloud -->
        <section class="my-0 py-0">
            <div class="md:h-72">
                <div class="relative bg-cover bg-no-repeat bg-center bg-autentikasi h-full rounded-3xl">
                    <img src="@src/images/landing/Autentikasi-Kanan.png" class="hidden md:block absolute inset-y-0 right-0 h-full">
                    <div class="flex items-center h-full">
                        <div class="p-8 md:px-16 md:py-0">
                            <div class="mb-10">
                                <h2 class="landing-h2 text-white mb-2.5">Autentikasi Digital Berbasis Cloud</h2>
                                <p class="landing-p text-white">Solusi berbasis cloud secara instan mengidentifikasi yang asli dari produk yang dipalsukan</p>
                            </div>
                            <button class="landing-btn-light text-white" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(16px);">
                                <div class="flex items-center space-x-3">
                                    <div>Bergabung Sekarang</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Solusi -->
        <section class="landing-section">
            <div class="flex flex-col-reverse md:flex-row md:items-center md:justify-between space-y-reverse space-y-10 md:space-y-0">
                <div class="md:basis-6/12">
                    <img src="@src/images/landing/Solusi.png" alt="Solusi Peredaran Produk Palsu" class="w-full">
                </div>
                <div class="md:basis-5/12">
                    <div>
                        <h2 class="landing-h2 mb-5">Solusi Untuk Mencegah Peredaran Produk Palsu</h2>
                        <p class="landing-p">Dengan menggunakan model smartphone apa pun, securetag dapat mengautentikasi produk dengan label produk fisik yang unik untuk mendapatkan visibilitas ke asal produk, geo-lokasi pemindaian autentikasi, dan aktivitas terkait rantai pasokan penting lainnya. </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Layanan Kami -->
        <section class="landing-section">
            <h2 class="landing-h2 text-center">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 md:gap-x-8 md:gap-y-0">
                <div class="border border-tertiary text-center px-8 py-16 rounded-xl">
                    <div class="w-28 h-36 mx-auto">
                        <img src="@src/images/landing/Smart-Label.png" alt="Smart Label" class="w-full">
                    </div>
                    <h3 class="landing-h3">Smart Label</h3>
                    <p class="landing-p">Securetag Membantu dalam pembuatan label barcode dan nomor seri produk, yang digunakan untuk mengetahui keaslian produk berbasis Qrcode & RFID/NFC.</p>
                </div>
                <div class="border border-tertiary text-center px-8 py-16 rounded-xl">
                    <div class="w-28 h-36 mx-auto">
                        <img src="@src/images/landing/Distribution-Tracking-System.png" alt="Distribution Tracking System" class="w-full">
                    </div>
                    <h3 class="landing-h3">Distribution Tracking System</h3>
                    <p class="landing-p">Bersama Securetag Dengan sistem pelacakan produk, kamu dapat mengetahui persebaran penjualan produkmu di setiap wilayah secara real time.</p>
                </div>
                <div class="relative bg-primary px-8 py-16 h-96 md:h-auto rounded-xl">
                    <div class="absolute -top-[11.3rem] -left-[11.3rem]">
                        <img src="@src/images/landing/Hubungi-Kami.png" class="w-[550px]">
                    </div>
                    <div class="flex items-end h-full">
                        <div>
                            <h3 class="landing-h3 text-white mb-8">Ingin kolaborasi dengan kami untuk mendapatkan banyak layanan lainnya?</h3>
                            <button>
                                <div class="flex items-center space-x-3 text-white">
                                    <div>Hubungi Kami</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kepercayaan Produk Terjamin -->
        <div class="bg-quaternary my-20">
            <section class="landing-section">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y space-y-10 md:space-y-0">
                    <div class="basis-6/12">
                        <div>
                            <h2 class="landing-h2 mb-5">Kepercayaan Produk Dijamin oleh SecureTag</h2>
                            <p class="landing-p leading-relaxed">Kami menjamin autentikasi produk secata instan. Melalui ketertelusuran di tingkat unit melalui smartphone, tanpa perlu mengunduh aplikasi terpisah.</p>
                        </div>
                    </div>
                    <div class="basis-5/12">
                        <div class="flex items-center justify-between md:justify-around">
                            <div>
                                <p class="landing-p mb-4">Product Release</p>
                                <h2 class="landing-h2 text-5xl md:text-6xl text-primary mb-0">1500+</h2>
                            </div>
                            <div>
                                <p class="landing-p mb-4">Satisfied Customer</p>
                                <h2 class="landing-h2 text-5xl md:text-6xl text-primary mb-0">2M</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Cara menggunakan SecureTag -->
        <section class="landing-section">
            <h2 class="landing-h2 text-center">
                Bagaimana cara mudah <br> menggunakan <span class="text-primary">SecureTag</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 md:gap-x-8 md:gap-y-0">
                <div class="border border-gray-100 text-center px-10 py-14 rounded-xl">
                    <div class="w-28 h-36 mx-auto">
                        <img src="@src/images/landing/Scan-Code.png" alt="Scan Code" class="w-full mb-6" style="background-color: red">
                    </div>
                    <h3 class="landing-h3">Scan Code</h3>
                    <p class="landing-p">Scan kode QR securetag yang terdapat pada kemasan atau label produk anda.</p>
                </div>
                <div class="border border-gray-100 text-center px-10 py-14 rounded-xl">
                    <div class="w-28 h-36 mx-auto">
                        <img src="@src/images/landing/Masukkan-PIN.png" alt="Masukkan PIN" class="w-full mb-6">
                    </div>
                    <h3 class="landing-h3">Masukkan PIN</h3>
                    <p class="landing-p">Masukan 6 digit PIN yang terdapat pada bagian bawah kode QR Securetag</p>
                </div>
                <div class="border border-gray-100 text-center px-10 py-14 rounded-xl">
                    <div class="w-28 h-36 mx-auto">
                        <img src="@src/images/landing/Sertifikat-Produk.png" alt="Sertifikat Produk" class="w-full mb-6">
                    </div>
                    <h3 class="landing-h3">Sertifikat Produk</h3>
                    <p class="landing-p">Jika produk original, maka anda akan mendapatkan sertifikasi keaslian produk.</p>
                </div>
            </div>
        </section>

        <!-- Keuntungan menggunakan SecureTag -->
        <section class="py-0 pt-20 my-20">
            <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0 mb-8">
                <div class="sm:grow flex flex-col-reverse sm:flex-row sm:items-center sm:space-x-8 bg-quaternary lg:pt-12 rounded-xl">
                    <div class="sm:grow">
                        <div class="px-8 py-8 sm:pb-0">
                            <h3 class="landing-h3">Laporan instan dan cepat dari hasil identifikasi produk</h3>
                            <p class="landing-p">Ketahui keaslian merek produk Anda secara real time untuk membangun kepercayaan dan  meningkatkan produktivitas bisnismu.</p>
                        </div>
                    </div>
                    <div class="sm:flex-none">
                        <img src="@src/images/landing/Mobile-Scan.png" alt="Mobile Scan" class="sm:w-64 lg:w-[22rem]">
                    </div>
                </div>
                <div class="lg:flex-auto bg-quaternary pt-12 rounded-xl">
                    <div class="lg:w-96 px-8 pb-8 lg:pb-0">
                        <img src="@src/images/landing/Produk-Aman.png" alt="Produk Aman dan Terjamin" class="w-20 mb-8">
                        <h3 class="landing-h3">Produk aman dan terjamin</h3>
                        <p class="landing-p">Solusi nyata dari permasalahan pemalsuan produk didalam bisnismu.</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
                <div class="lg:flex-auto flex items-center bg-quaternary py-8 lg:py-0 rounded-xl">
                    <div class="lg:w-96 px-8">
                        <img src="@src/images/landing/Lokasi-Produk.png" alt="Lokasi Produk" class="w-20 mb-8">
                        <h3 class="landing-h3">Monitoring titik pesebaran lokasi produk</h3>
                        <p class="landing-p">Menampilkan data ketertelusuran di tingkat unit dari setiap produk yang dijual</p>
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row sm:items-center bg-quaternary rounded-xl">
                    <div>
                        <div class="px-8 sm:pb-0 py-8">
                            <h3 class="landing-h3">Membangun relasi bisnis dengan Integrasi API</h3>
                            <p class="landing-p">Kami memberikan layanan open API bagi platform yang ingin berkerjasama dengan Securetag dalam memberantas pemalsuan produk</p>
                        </div>
                    </div>
                    <div class="sm:flex-none px-8">
                        <img src="@src/images/landing/Relasi-Bisnis.png" alt="Relasi Bisnis" class="sm:w-64 lg:w-96">
                    </div>
                </div>
            </div>
        </section>

        <!-- Integrasi API -->
        <section class="landing-section">
            <h6 class="font-bold text-primary text-center mb-2">INTEGRASI API</h6>
            <h2 class="landing-h2 text-center">
                Mulai Digitalisasi Keaslian Produk <br> Anda dari Sekarang
            </h2>
            <div class="flex flex-col sm:flex-row sm:justify-center sm:space-x-8 space-y-8 sm:space-y-0">
                <div class="plan-card from-[#BFC9E0]">
                    <div class="bg-white h-full rounded-t-sm rounded-b-2xl px-6 pt-12 pb-6">
                        <div class="flex flex-col justify-between h-full">
                            <div>
                                <h3 class="landing-h3 font-bold text-[#8094C2] text-2xl lg:text-3xl mb-6">BASIC PLAN</h3>
                                <ul class="text-secondary space-y-3 mb-12">
                                    <li class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8094C2" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="landing-p">Get Customer Data</p>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8094C2" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="landing-p">Get Validation QrCode</p>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8094C2" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="landing-p">Get Status Authentication Qr Code</p>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8094C2" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="landing-p">Post Report Qr Code Duplicate / Fake</p>
                                    </li>
                                </ul>
                            </div>
                            <button class="landing-btn-light w-full">Bergabung Sekarang</button>
                        </div>
                    </div>
                </div>
                <div class="plan-card from-primary">
                    <div class="bg-white h-full rounded-t-sm rounded-b-2xl px-6 pt-12 pb-6">
                        <h3 class="landing-h3 font-bold text-primary text-2xl lg:text-3xl mb-6">PREMIUM PLAN</h3>
                        <ul class="text-secondary space-y-3 mb-12">
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Dashboard Panel Partner</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Bisnis Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Product Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Request QR Code Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Type QR Code Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Data Customer Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Social Media Data</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Status Authentication QR Code</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Post Report QR Code Duplicate / Fake</p>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 fill-primary">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                                <p class="landing-p">Get Profile</p>
                            </li>
                        </ul>
                        <button class="landing-btn-primary w-full">Bergabung Sekarang</button>
                    </div>
                </div>
            </div>
        </section>


        <!-- Pentingnya Menggunakan Label -->
        <section class="landing-section">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between md:space-x-8 space-y-8 md:space-y-0">
                <div class="md:basis-6/12">
                    <h2 class="landing-h2">Mengapa pentingnya <br> menggunakan label <br> SecureTag</h2>
                    <ul class="space-y-8 text-[#4A4A68]">
                        <li class="flex items-start space-x-6">
                            <img src="@src/images/landing/Pentingnya-Label.png" alt="Pentingnya Label" class="w-12">
                            <div>
                                <h3 class="landing-h3 mb-2">Meningkatkan kepercayaan customer</h3>
                                <p class="landing-p">Membangun kepercayaan merek produk Anda kepada pelanggan sehingga meningkatkan penjualan </p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-6">
                            <img src="@src/images/landing/Pentingnya-Label.png" alt="Pentingnya Label" class="w-12">
                            <div>
                                <h3 class="landing-h3 mb-2">Efisien dan mudah digunakan</h3>
                                <p class="landing-p">Scan mudah dengan handphone untuk mengautentikasi produk dengan label produk fisik yang unik</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-6">
                            <img src="@src/images/landing/Pentingnya-Label.png" alt="Pentingnya Label" class="w-12">
                            <div>
                                <h3 class="landing-h3 mb-2">Memberantas produk palsu</h3>
                                <p class="landing-p">Bersama perangi dan berantas produk palsu yang beredar.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="md:basis-5/12">
                    <img src="@src/images/landing/Dashboard.png" class="w-full">
                </div>
            </div>
        </section>

        <!-- Partner -->
        <section class="bg-[#FBFBFB] max-w-none py-6 my-20">
            <div class="flex flex-wrap justify-center md:justify-around max-w-6xl mx-auto">
                <div class="flex-none mr-16 md:mr-0 mb-8">
                    <img src="@src/images/landing/Sun-Life.png" alt="Partner" class="partner-logo">
                </div>
                <div class="flex-none mr-16 md:mr-0 mb-8">
                    <img src="@src/images/landing/Telkomsel.png" alt="Partner" class="partner-logo">
                </div>
                <div class="flex-none mr-16 md:mr-0 mb-8">
                    <img src="@src/images/landing/Indofood.png" alt="Partner" class="partner-logo">
                </div>
                <div class="flex-none mr-16 md:mr-0 mb-8">
                    <img src="@src/images/landing/Indofood.png" alt="Partner" class="partner-logo">
                </div>
                <div class="flex-none mr-16 md:mr-0 mb-8">
                    <img src="@src/images/landing/Lembaga-Sensor-Film.png" alt="Partner" class="partner-logo">
                </div>
            </div>
        </section>

        <!-- SecureTag -->
        <section class="landing-section">
            <h2 class="landing-h2 text-primary text-center">SecureTag</h2>
            <div class="max-w-3xl mx-auto">
                <p class="landing-p text-justify mb-16">
                    Berawal dari perusahaan yang pertama di Indonesia mengenalkan hologram untuk produk. Hologram TETAP dapat dipalsukan. Bagaimana tidak, tingkat kemiripan daripada penduplikasian Hologram dapat mencapai 80-90%. Hal tersebut menimbulkan kekhawatiran bagi para pembeli maupun para pemilik brand dalam menjaga keaslian produk mereka. <br><br>

                    Kini Labelin.co melalui teknologi Securetag dalam bentuk QR Code yang Terenkripsi. Mudah diaplikasikan melalu label  stiker atau hologram yang dapat di tempel pada produk. Memberikan informasi foto produk, produk detail hingga melibatkan konsumen dari memberikan tanggapan. Hindari produk yang tidak terdaftar atau terduplikasi. Kami memiliki kontrol penuh terhadap produk yang di jual belikan dengan perlindungan Securetag.
                </p>
                <img src="@src/images/landing/Scan-Machine.png" alt="Scan Machine" class="mb-16">
                <div class="mb-16">
                    <h3 class="landing-h3">Tentang Kami</h3>
                    <p class="landing-p">Labelin.co merupakan layanan tag API printing berteknologi securetag dalam bentuk label yang bisa di tempel pada produk. Dengan Labelin.co para business owner dapat menjaga originalitas produk/karya mereka hingga sampai ke tangan customer dengan membedakan produk asli dan palsu di pasaran.</p>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:space-x-8 space-y-8 sm:space-y-0">
                    <div class="flex-1 border border-tertiary p-8 rounded-xl">
                        <img src="@src/images/landing/Visi.png" alt="Visi" class="w-12 mb-6">
                        <h3 class="landing-h3 mb-2">Visi Kami</h3>
                        <p class="landing-p">Menjadi perusahaan pengembang kemasan dengan teknologi Internet Of Thing (IoT) terpercaya di Indonesia dengan kemampuan bersaing secara universal dan memberi nilai tambah kedapa seluruh pemilik bisnis atau business owner.</p>
                    </div>
                    <div class="flex-1 border border-tertiary p-8 rounded-xl">
                        <img src="@src/images/landing/Misi.png" alt="Misi" class="w-12 mb-6">
                        <h3 class="landing-h3 mb-2">Misi Kami</h3>
                        <ul class="list-disc">
                            <li>
                                <p class="landing-p">Menyediakan produk yang berkualitas, aman dan menyeluruh.</p>
                            </li>
                            <li>
                                <p class="landing-p">Memberikan solusi dan kepercayaan kepada business owner dan konsumen agar terhindar dari produk-produk palsu.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pertanyaan yang sering diajukan -->
        <section name="pertanyaan" class="bg-quaternary max-w-none my-20">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="landing-h2 mb-5">Pertanyaan yang Sering Diajukan</h2>
                    <p class="landing-p">Kami selalu menjawab pertanyaan kebutuhan Anda. Masih ada pertanyaan yang ingin diajukan? Klik button dibawah untuk mengetahui jenis pertanyaan yang sering ditanyakan.</p>
                </div>
                <ul class="space-y-6 mb-16">
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Apa itu SecuteTag?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Labelin.co merupakan layanan tag API printing berteknologi securetag dalam bentuk label yang bisa di tempel pada produk. Dengan Labelin.co para business owner dapat menjaga originalitas produk/karya mereka hingga sampai ke tangan customer dengan membedakan produk asli dan palsu di pasaran.</p>
                        </div>
                    </li>
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Bagaimana cara menggunakan Securetag?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita veritatis ipsum tenetur adipisci voluptatum dolor amet labore maiores! Inventore ut consectetur iusto laudantium vel mollitia temporibus cumque pariatur, numquam necessitatibus.</p>
                        </div>
                    </li>
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Bagaimana cara Securetag membedakan produk asli atau palsu?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum natus maxime. Earum, delectus. Maiores numquam corrupti ipsam obcaecati cupiditate cumque, natus laboriosam pariatur quis velit, aspernatur debitis saepe repellat?</p>
                        </div>
                    </li>
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Bagaimana memilih materi pembelajaran yang akan saya ikuti?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum natus maxime. Earum, delectus. Maiores numquam corrupti ipsam obcaecati cupiditate cumque, natus laboriosam pariatur quis velit, aspernatur debitis saepe repellat?</p>
                        </div>
                    </li>
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Saya sudah menentukan materi pembelajaran yang di inginkan?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum natus maxime. Earum, delectus. Maiores numquam corrupti ipsam obcaecati cupiditate cumque, natus laboriosam pariatur quis velit, aspernatur debitis saepe repellat?</p>
                        </div>
                    </li>
                    <li class="faq">
                        <div class="accordion">
                            <p class="landing-p">Saya sudah menentukan materi pembelajaran yang di inginkan?</p>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#4A4A68" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="panel">
                            <p class="landing-p p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum natus maxime. Earum, delectus. Maiores numquam corrupti ipsam obcaecati cupiditate cumque, natus laboriosam pariatur quis velit, aspernatur debitis saepe repellat?</p>
                        </div>
                    </li>
                </ul>
                <div class="text-center">
                    <button class="landing-btn-primary">
                        <div class="flex items-center space-x-3">
                            <div>Konsultasi Sekarang</div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </section>

        <!-- Hubungi Kami -->
        <section class="landing-section">
            <div class="text-center mb-10">
                <h3 class="landing-h3">Hubungi Kami</h3>
                <p class="landing-p">Tinggalkan detail kontak Anda dan tim kami akan segera menghubungi Anda!</p>
            </div>
            <div class="max-w-3xl mx-auto">
                <form action="#">
                    <div class="mb-6">
                        <label class="landing-label" for="">Nama <span class="label-required">*</span></label>
                        <input class="landing-form-input" type="text">
                    </div>
                    <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-6 sm:space-y-0 mb-6">
                        <div class="flex-1">
                            <label class="landing-label" for="">Email <span class="label-required">*</span></label>
                            <input class="landing-form-input" type="email">
                        </div>
                        <div class="flex-1">
                            <label class="landing-label" for="">No Telp <span class="label-required">*</span></label>
                            <input class="landing-form-input" type="number">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-6 sm:space-y-0 mb-6">
                        <div class="flex-1">
                            <label class="landing-label" for="">Perusahaan <span class="label-required">*</span></label>
                            <input class="landing-form-input" type="email">
                        </div>
                        <div class="flex-1">
                            <label class="landing-label" for="">Industri <span class="label-required">*</span></label>
                            <input class="landing-form-input" type="text">
                        </div>
                    </div>
                    <div>
                        <label class="landing-label" for="">Informasi Anda <span class="label-required">*</span></label>
                        <textarea class="landing-form-input" rows="5"></textarea>
                    </div>
                    <div class="text-end mt-10">
                        <button class="landing-btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Kami Siap Membantu -->
        <section class="landing-section">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-10">
                    <h3 class="landing-h3">Kami di sini untuk membantu</h3>
                    <p class="landing-p">Tertarik untuk mendiskusikan kerjasama atau ingin mempelajari lebih lanjut tentang Securetag? <br> Kami akan senang mendengar dari Anda!</p>
                </div>
                <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0">
                    <div class="flex-1 border border-[#E7EEFE] py-8 rounded-xl text-center">
                        <img src="@src/images/landing/Alamat.png" alt="Alamat" class="w-12 mx-auto mb-6">
                        <div>
                            <p class="landing-p font-bold mb-2">Alamat Kantor Pusat</p>
                            <p class="landing-p">Jl. Surabaya</p>
                        </div>
                    </div>
                    <div class="flex-1 border border-[#E7EEFE] py-8 rounded-xl text-center">
                        <img src="@src/images/landing/Alamat.png" alt="Alamat" class="w-12 mx-auto mb-6">
                        <div>
                            <p class="landing-p font-bold mb-2">Nomor Panggilan</p>
                            <p class="landing-p">Mobile: (+62) 81299903331</p>
                        </div>
                    </div>
                    <div class="flex-1 border border-[#E7EEFE] py-8 rounded-xl text-center">
                        <img src="@src/images/landing/Alamat.png" alt="Alamat" class="w-12 mx-auto mb-6">
                        <div>
                            <p class="landing-p font-bold mb-2">e-Mail untuk Informasi</p>
                            <p class="landing-p">info@labelin.co</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mari Berantas Produk Palsu -->
        <section class="landing-section">
            <div class="relative bg-primary h-[19.5rem] rounded-2xl p-8 lg:p-0">
                <img src="@src/images/landing/Berantas-Kiri.png" alt="Berantas Kiri" class="absolute inset-y-0 left-0 h-full rounded-l-2xl">
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <h2 class="landing-h2 text-white mb-5">Mari Berantas Produk Palsu <br> Bersama Securetag!</h2>
                        <p class="landing-p text-white">Identifikasi produk palsu secara digital dimanapun dan kapanpun</p>
                    </div>
                </div>
                <img src="@src/images/landing/Berantas-Kanan.png" alt="Berantas Kanan" class="hidden lg:block absolute inset-y-0 -right-2/3 lg:right-0 h-full rounded-r-2xl">
            </div>
        </section>

        <footer class="bg-[#163042] text-white pt-44 -mt-64">
            <section class="pb-9">
                <h3 class="landing-h3 text-white">SecureTag</h3>
                <div class="flex flex-col lg:flex-row lg:justify-between space-y-10 lg:space-y-0 mb-16">
                    <div class="basis-5/12">
                        <p class="landing-p text-white">Labelin.co merupakan layanan tag API printing berteknologi securetag dalam bentuk label yang bisa di tempel pada produk. Dengan Labelin.co para business owner dapat menjaga originalitas produk/karya mereka hingga sampai ke tangan customer dengan membedakan produk asli dan palsu di pasaran.</p>
                    </div>
                    <div class="basis-6/12 flex flex-col md:flex-row space-y-10 md:space-y-0">
                        <div class="flex-1">
                            <ul class="space-y-2">
                                <li>Privacy Policy</li>
                                <li>Disclaimer</li>
                                <li>Terms & Conditions</li>
                                <li>FAQ's</li>
                            </ul>
                        </div>
                        <div class="flex-1">
                            <ul class="space-y-2">
                                <li>PT SecureTag Indonesia</li>
                                <li>Surabaya</li>
                                <li>Phone: 081299903331</li>
                                <li>Email: info@labelin.co</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-6 lg:space-y-0">
                    <p class="landing-p text-sm text-white">© 2023 Securetag. All rights reserved </p>
                    <ul class="flex space-x-6 lg:space-x-10">
                        <li>
                            <img src="@src/images/landing/Facebook.png" alt="Facebook" class="sosial-media-icon">
                        </li>
                        <li>
                            <img src="@src/images/landing/Instagram.png" alt="Instagram" class="sosial-media-icon">
                        </li>
                        <li>
                            <img src="@src/images/landing/YouTube.png" alt="YouTube.png" class="sosial-media-icon">
                        </li>
                        <li>
                            <img src="@src/images/landing/LinkedIn.png" alt="LinkedIn.png" class="sosial-media-icon">
                        </li>
                    </ul>
                </div>
            </section>

            <hr class="border-2 border-[#2A3C48] py-5">
        </footer>

        <div class="fixed right-4 bottom-4 transition">
            <div>
                <button class="bg-primary rounded-full focus:outline-none">
                    <a href="#" class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-white w-5 h-5 md:w-6 md:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                        </svg>
                    </a>
                </button>
                <button @click="scrollToTop" ref="scrollTopButton" class="hidden bg-primary w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full focus:outline-none mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-white w-5 h-5 md:w-6 md:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75" />
                    </svg>
                </button>
            </div>
        </div>

        <Modal :open-modal="true" @closeModal="openModal = false">
            <div class="py-5 md:px-3 md:py-8">
                <div class="font-semibold text-lg mb-8">Modal Title</div>
                <div class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam a tempore laboriosam voluptates aspernatur excepturi praesentium sequi quod? Sed unde veniam, qui est quos soluta officiis. Veritatis veniam sunt autem.</div>
            </div>
        </Modal>
    </div>
</template>
