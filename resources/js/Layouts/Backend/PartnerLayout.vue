<script setup>
import Sidebar from '@/Components/Partner/Sidebar.vue'
import Header from '@/Components/Partner/Header.vue'
import Footer from '@/Components/Partner/Footer.vue'
import { ref, onMounted } from 'vue'

const openSidebar = ref(false)
</script>

<template>
    <div class="bg-dashboard">
        <!-- Page Sidebar -->
        <Sidebar :open-sidebar="openSidebar" @closeSidebar="openSidebar = false"/>

        <div class="px-4 md:px-8 pb-8">
            <!-- Page Header -->
            <Header @openSidebar="openSidebar = true"/>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <!-- Page Footer -->
        <Footer/>
    </div>
</template>
