<script setup>
import Sidebar from '@/Components/Partner/Sidebar.vue'
import Header from '@/Components/Partner/Header.vue'
import Footer from '@/Components/Partner/Footer.vue'
import Alert from '@/Components/Alert.vue'
import { ref, onMounted } from 'vue'

const openSidebar = ref(false)

// const flash = ref({ type: 'success', message: 'Data successfully added!' })
</script>

<template>
    <div class="bg-dashboard">
        <!-- Flash Message -->
        <div v-if="$page.props.flash">
            <Alert :flash="$page.props.flash"/>
        </div>

        <!-- Page Sidebar -->
        <Sidebar :open-sidebar="openSidebar" @closeSidebar="openSidebar = false"/>

        <div class="min-h-screen flex flex-col justify-between">
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
    </div>
</template>
