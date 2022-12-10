<script setup>
import Sidebar from '@/Components/Partner/Sidebar.vue'
import Header from '@/Components/Partner/Header.vue'
import Footer from '@/Components/Partner/Footer.vue'
</script>

<template>
    <div class="bg-dashboard">
        <!-- Page Sidebar -->
        <!-- <Sidebar/> -->

        <div class="px-4 md:px-8 pb-8">
            <!-- Page Header -->
            <Header/>

            <!-- Page Content -->
            <main>
                <slot />
            </main>

            <!-- Page Footer -->
            <Footer/>
        </div>
    </div>
</template>
