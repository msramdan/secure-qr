<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import Footer from '@/Components/Admin/Footer.vue'
import Alert from '@/Components/Alert.vue'
import { ref, reactive } from 'vue'

const openSidebar = ref(window.innerWidth >= 1024 ? true : false)

// const flash = reactive({ type: 'success', message: 'Data successfully added!' })
</script>

<template>
    <div class="bg-main">
        <!-- Flash Message -->
        <div v-if="$page.props.flash">
            <Alert :flash="$page.props.flash"/>
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
