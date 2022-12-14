<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import Footer from '@/Components/Admin/Footer.vue'
</script>

<template>
    <div class="bg-black">
        <div class="flex justify-center">
            <div class="relative bg-white w-full sm:w-[400px] min-h-screen flex flex-col justify-between">
                <div>
                    <div class="bg-white py-3">
                        <slot name="logo"/>
                    </div>

                    <!-- Serial Number -->
                    <div class="jumbotron-validation">
                        <slot name="jumbotron"/>
                    </div>

                    <!-- Konten -->
                    <div class="content-validation">
                        <slot/>
                    </div>
                </div>

                <slot name="bottom-content"/>

                <!-- Modal -->
                <slot name="modal"/>
            </div>
        </div>
    </div>
</template>
