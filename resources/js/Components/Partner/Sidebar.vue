<script setup>
import logo from '@src/images/logo.gif'
import { ref } from 'vue'

const openedMenu = ref('')

const props = defineProps({
  openSidebar: Boolean
});

const emit = defineEmits(['closeSidebar']);

function closeSidebar() {
    emit('closeSidebar');
}

function handleOpenedMenu(menu) {
    openedMenu.value == menu ? openedMenu.value = '' : openedMenu.value = menu
}
</script>

<template>
    <nav
        @click="closeSidebar"
        class="fixed z-50" :class="{ 'inset-0 bg-black bg-opacity-30': openSidebar }"
    >
        <Transition
            enter-from-class="-translate-x-64"
            enter-active-class="transition ease-in-out duration-300"
            enter-to-class="translate-x-0"
            leave-from-class="translate-x-0"
            leave-active-class="transition ease-in-out duration-300"
            leave-to-class="-translate-x-64"
        >
            <div v-if="openSidebar" class="bg-white w-64 h-screen shadow-main overflow-y-auto z-50" @click.stop>
                <div class="sticky top-0 bg-white">
                    <div class="flex items-center justify-between px-5 py-3.5">
                        <div class="flex items-center space-x-3">
                            <img :src="logo" alt="Logo" class="w-12">
                            <h1 class="text-3xl text-gray-400">vito</h1>
                        </div>
                        <button @click="closeSidebar" class="lg:hidden bg-dashboard flex items-center justify-center w-10 h-10 rounded-lg focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-purple-1100 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="py-3 pr-4">
                    <ul>
                        <li class="px-5 py-3 cursor-pointer text-purple-1000 hover:text-purple-1100 mb-1">
                            <div class="flex items-center space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span class="font-medium">Dashboard</span>
                            </div>
                        </li>
                        <li class="group cursor-pointer text-purple-1000 mb-1">
                            <div @click="handleOpenedMenu('social')" class="px-5 py-3 group-hover:text-purple-1100" :class="{ 'bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 text-white group-hover:text-white rounded-tr-2xl ': openedMenu == 'social' }">
                                <div class="flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="flex-none w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    <div class="grow flex items-center justify-between">
                                        <span class="font-medium">Social</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ease-out duration-300" :class="[ openedMenu == 'social' ? 'rotate-90' : 'rotate-0' ]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <Transition
                                enter-from-class="scale-y-0 -translate-y-1/2"
                                enter-active-class="transition ease-in-out duration-500"
                                enter-to-class="scale-100 translate-y-0"
                            >
                                <ul v-if="openedMenu == 'social'" class="bg-[#EFEEFD] pl-5 rounded-br-2xl">
                                    <li class="hover:text-purple-1100 py-3">Email</li>
                                    <li class="hover:text-purple-1100 py-3">Chat</li>
                                    <li class="hover:text-purple-1100 py-3">Todo</li>
                                    <li class="hover:text-purple-1100 py-3">Calender</li>
                                </ul>
                            </Transition>
                        </li>
                        <li class="group cursor-pointer text-purple-1000 mb-1">
                            <div @click="handleOpenedMenu('user')" class="px-5 py-3 group-hover:text-purple-1100" :class="{ 'bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 text-white group-hover:text-white rounded-tr-2xl ': openedMenu == 'user' }">
                                <div class="flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="flex-none w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    <div class="grow flex items-center justify-between">
                                        <span class="font-medium">User</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ease-out duration-300" :class="[ openedMenu == 'user' ? 'rotate-90' : 'rotate-0' ]">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <Transition
                                enter-from-class="scale-y-0 -translate-y-1/2"
                                enter-active-class="transition ease-in-out duration-500"
                                enter-to-class="scale-100 translate-y-0"
                            >
                                <ul v-if="openedMenu == 'user'" class="bg-[#EFEEFD] pl-5 rounded-br-2xl">
                                    <li class="hover:text-purple-1100 py-3">Email</li>
                                    <li class="hover:text-purple-1100 py-3">Chat</li>
                                    <li class="hover:text-purple-1100 py-3">Todo</li>
                                    <li class="hover:text-purple-1100 py-3">Calender</li>
                                </ul>
                            </Transition>
                        </li>
                    </ul>
                </div>
            </div>
        </Transition>
    </nav>
</template>
