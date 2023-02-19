<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import Footer from '@/Components/Admin/Footer.vue'
import Alert from '@/Components/Alert.vue'
import { ref, computed } from 'vue'

const openSidebar = ref(window.innerWidth >= 1024 ? true : false)

const flash = ref(usePage().props.value.flash)
const flashExist = computed(() =>
    flash.value.success || flash.value.danger || flash.value.warning || flash.value.info
);
</script>

<template>
    <div class="bg-main">
        <!-- Flash Message -->
        <div v-if="flashExist">
            <Alert :flash="flash"/>
        </div>

        <!-- Page Sidebar -->
        <Sidebar :open-sidebar="openSidebar" @closeSidebar="openSidebar = false"/>

        <div class="lg:ml-64 min-h-screen flex flex-col justify-between">
            <div class="px-4 md:px-8 pb-8">
                <!-- Page Header -->
                <Header @openSidebar="openSidebar = true"/>

                <!-- Page Content -->
                <main>
                    <slot/>
                </main>
            </div>

            <!-- Page Footer -->
            <Footer/>
        </div>
    </div>
</template>
