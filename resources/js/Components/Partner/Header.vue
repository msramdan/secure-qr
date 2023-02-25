<script setup>
import user1 from '@src/images/user-1.jpg'
import { ref } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import HeaderLink from './HeaderLink.vue';

const openedMenu = ref('')

const emit = defineEmits(['openSidebar']);

function openSidebar() {
   emit('openSidebar');
}

const openUserOption = ref(false)
const openNotification = ref(false)
</script>

<template>
    <header class="sticky top-0 bg-dashboard pt-5 rounded-b-2xl z-20">
        <div class="bg-white rounded-xl shadow-main px-5 py-4 mb-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="font-bold text-2xl mt-0 mb-5 sm:mb-0">Page Title</div>
                <ul class="hidden xl:flex items-center space-x-10 overflow-x-auto">
                    <HeaderLink name="Dashboard" href="/partner/dashboard" :active="$page.url === '/partner/dashboard'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </HeaderLink>
                    <HeaderLink name="Bisnis" href="/partner/bisnis" :active="$page.url === '/partner/bisnis'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                    </HeaderLink>
                    <HeaderLink name="Produk" href="/partner/produk" :active="$page.url === '/partner/produk'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </HeaderLink>
                    <HeaderLink name="Request QR" href="/partner/request_qrcode" :active="$page.url === '/partner/request_qrcode'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                    </HeaderLink>
                    <HeaderLink name="Customer Data" href="/partner/customer_data" :active="$page.url === '/partner/customer_data'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </HeaderLink>
                    <HeaderLink name="Official Links" href="/partner/links" :active="$page.url === '/partner/links'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                    </HeaderLink>
                </ul>
                <div class="flex items-center justify-end space-x-4 xl:space-x-6">
                    <div class="flex items-center space-x-4 xl:space-x-6 text-purple-1100">
                        <button  @click="openNotification = !openNotification; openUserOption = false" class="focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button>
                        <Link href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                        </Link>
                        <button @click="openSidebar" class="xl:hidden bg-dashboard flex items-center justify-center w-10 h-10 rounded-lg focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                            </svg>
                        </button>
                    </div>
                    <img @click="openUserOption = !openUserOption; openNotification = false" :src="user1" alt="User" class="w-12 rounded-xl cursor-pointer">
                </div>
            </div>

            <transition
                enter-from-class="opacity-10 translate-y-1/4"
                enter-active-class="transition ease-out duration-700"
                enter-to-class="translate-y-0"
            >
                <div v-if="openNotification" class="absolute right-0 mt-4 bg-white shadow-main w-72 rounded-xl">
                    <div class="bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 rounded-t-xl px-4 py-3">
                        <div class="flex items-center justify-between">
                            <h6 class="text-lg text-white">All Notifications</h6>
                            <div class="bg-white flex items-center justify-center w-6 h-6 font-medium text-sm rounded">4</div>
                        </div>
                    </div>
                    <ul>
                        <li class="flex items-end space-x-4 p-4 border-b">
                            <div class="flex-1">
                                <div class="mb-0.5">Notification 1</div>
                                <div class="text-sm text-purple-1000">Notification Description 1</div>
                            </div>
                            <div class="flex-none text-sm text-purple-1000">Just now</div>
                        </li>
                        <li class="flex items-end space-x-4 p-4 border-b">
                            <div class="flex-1">
                                <div class="mb-0.5">Notification 2</div>
                                <div class="text-sm text-purple-1000">Notification Description 2</div>
                            </div>
                            <div class="flex-none text-sm text-purple-1000">30m ago</div>
                        </li>
                        <li class="flex items-end space-x-4 p-4 border-b">
                            <div class="flex-1">
                                <div class="mb-0.5">Notification 3</div>
                                <div class="text-sm text-purple-1000">Notification Description 3</div>
                            </div>
                            <div class="flex-none text-sm text-purple-1000">2h ago</div>
                        </li>
                    </ul>
                </div>
            </transition>

            <transition
                enter-from-class="opacity-10 translate-y-1/4"
                enter-active-class="transition ease-out duration-700"
                enter-to-class="translate-y-0"
            >
                <div v-if="openUserOption" class="absolute right-0 mt-4 bg-white shadow-main w-72 rounded-xl">
                    <div class="bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 rounded-t-xl px-4 py-3 text-white">
                        <h6 class="text-lg">Hello Nik Jone</h6>
                        <div class="text-xs">Available</div>
                    </div>
                    <ul>
                        <!-- <li class="flex items-center space-x-4 p-4 border-b">
                            <div class="bg-[#E7E4FC] rounded-xl flex items-center justify-center w-11 h-11 text-[#827AF3]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <div>My Profile</div>
                                <div class="text-xs text-purple-1000">View personal profile detail</div>
                            </div>
                        </li> -->
                        <li class="p-4 border-b">
                            <Link href="/partner/profile" class="flex items-center space-x-4 focus:outline-none">
                                <div class="bg-[#E7E4FC] rounded-xl flex items-center justify-center w-11 h-11 text-[#827AF3]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </div>
                                <div>
                                    <div>Edit Profile</div>
                                    <div class="text-xs text-purple-1000">Modify your personal detail</div>
                                </div>
                            </Link>
                        </li>
                    </ul>
                    <div class="flex justify-center p-4">
                        <Link :href="route('partner.logout')" method="post" class="bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 flex items-center space-x-2 px-4 py-2 rounded-xl text-white">
                            <span class="font-medium text-sm">Sign out</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </transition>
        </div>
    </header>
</template>

<style scoped>
.header-shadow {
    box-shadow: 0px 0px 25px 0px rgb(45 69 95 / 10%)
}
</style>
