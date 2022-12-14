<script setup>
import user1 from '@src/images/user-1.jpg'
import { ref } from 'vue'

const openedMenu = ref('')

const emit = defineEmits(['openSidebar']);

function openSidebar() {
   emit('openSidebar');
}

const openUserOption = ref(false)
</script>

<template>
    <header class="sticky top-0 bg-dashboard pt-5 rounded-b-2xl">
        <div class="bg-white rounded-xl shadow-main px-5 py-4 mb-5">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="font-bold text-2xl mt-0 mb-5 lg:mb-0">Page Title</div>
                <ul class="hidden lg:flex items-center space-x-10">
                    <li class="group relative text-purple-1000 cursor-pointer">
                        <div class="flex items-center space-x-3 group-hover:text-purple-1100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </div>
                    </li>
                    <li @mouseenter="openedMenu = 'email'" @mouseleave="openedMenu = ''" class="group relative text-purple-1000 cursor-pointer">
                        <div class="flex items-center space-x-3 group-hover:text-purple-1100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <div class="flex items-center space-x-1.5">
                                <span class="font-medium">Email</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:rotate-90 ease-out duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </div>
                        <Transition
                            enter-from-class="scale-y-0 -translate-y-1/2"
                            enter-active-class="transition ease-in-out duration-500"
                            enter-to-class="scale-100 translate-y-0"
                            leave-from-class="scale-100 translate-y-0"
                            leave-active-class="transition ease-in-out duration-300"
                            leave-to-class="scale-y-0 -translate-y-1/2"
                        >
                            <div v-if="openedMenu == 'email'" class="absolute">
                                <div class="bg-white w-48 rounded-lg shadow-sm px-4 pt-8 pb-3">
                                    <ul class="font-medium">
                                        <li class="hover:text-purple-1100 mb-4">Email</li>
                                        <li class="hover:text-purple-1100 mb-4">Chat</li>
                                        <li class="hover:text-purple-1100 mb-4">Todo</li>
                                        <li class="hover:text-purple-1100">Calender</li>
                                    </ul>
                                </div>
                            </div>
                        </Transition>
                    </li>
                    <li @mouseenter="openedMenu = 'user'" @mouseleave="openedMenu = ''" class="group relative text-purple-1000 cursor-pointer">
                        <div class="flex items-center space-x-3 group-hover:text-purple-1100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <div class="flex items-center space-x-1.5">
                                <span class="font-medium">User</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 group-hover:rotate-90 ease-out duration-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </div>
                        <Transition
                            enter-from-class="scale-y-0 -translate-y-1/2"
                            enter-active-class="transition ease-in-out duration-500"
                            enter-to-class="scale-100 translate-y-0"
                            leave-from-class="scale-100 translate-y-0"
                            leave-active-class="transition ease-in-out duration-300"
                            leave-to-class="scale-y-0 -translate-y-1/2"
                        >
                            <div v-if="openedMenu == 'user'" class="absolute">
                                <div class="bg-white w-48 rounded-lg shadow-sm px-4 pt-8 pb-3">
                                    <ul class="font-medium">
                                        <li class="hover:text-purple-1100 mb-4">Email</li>
                                        <li class="hover:text-purple-1100 mb-4">Chat</li>
                                        <li class="hover:text-purple-1100 mb-4">Todo</li>
                                        <li class="hover:text-purple-1100">Calender</li>
                                    </ul>
                                </div>
                            </div>
                        </Transition>
                    </li>
                </ul>
                <div class="flex items-center justify-end space-x-4 lg:space-x-5">
                    <div class="flex items-center space-x-4 lg:space-x-5 text-purple-1100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="hidden lg:block w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="hidden lg:block w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <button @click="openSidebar" class="lg:hidden bg-dashboard flex items-center justify-center w-10 h-10 rounded-lg focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button class="lg:hidden bg-dashboard flex items-center justify-center w-10 h-10 rounded-lg focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                    <img @click="openUserOption = !openUserOption" :src="user1" alt="User" class="w-12 rounded-xl cursor-pointer">
                </div>
            </div>
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
                        <li class="flex items-center space-x-4 p-4 border-b">
                            <div class="bg-[#E7E4FC] rounded-xl flex items-center justify-center w-11 h-11 text-[#827AF3]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <div>My Profile</div>
                                <div class="text-xs text-purple-1000">View personal profile detail</div>
                            </div>
                        </li>
                        <li class="flex items-center space-x-4 p-4 border-b">
                            <div class="bg-[#E7E4FC] rounded-xl flex items-center justify-center w-11 h-11 text-[#827AF3]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div>
                                <div>Edit Profile</div>
                                <div class="text-xs text-purple-1000">Modify your personal detail</div>
                            </div>
                        </li>
                    </ul>
                    <div class="flex justify-center p-4">
                        <button class="bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 flex items-center space-x-2 px-4 py-2 rounded-xl text-white">
                            <span class="font-medium text-sm">Sign out</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </button>
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
