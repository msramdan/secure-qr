<script setup>
import { ref } from 'vue'

const openFilerOption = ref(false)
</script>

<template>
    <div class="card-dashboard mb-8">
        <div class="relative">
            <div class="flex items-center justify-between mb-10">
                <h2 class="card-title-dashboard mb-0">Filter Data</h2>
                <button @click="openFilerOption = !openFilerOption" class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-purple-1000 hover:text-gray-900 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                    </svg>
                </button>
            </div>
            <div v-show="openFilerOption" class="absolute top-8 right-0" @click.stop>
                <div class="bg-white w-40 shadow-main p-6 rounded-lg">
                    <ul class="font-medium">
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer mb-2">Weekly</li>
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer mb-2">Monthly</li>
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer">This Year</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <form class="form mb-5" action="#">
            <div class="w-full flex flex-col md:flex-row md:items-end space-x-0 md:space-x-5 space-y-5">
                <div class="md:w-56">
                    <label for="" class="form-label-dashboard">Start Date</label>
                    <input type="date" class="form-input-dashboard">
                </div>
                <div class="md:w-56">
                    <label for="" class="form-label-dashboard">End Date</label>
                    <input type="date" class="form-input-dashboard">
                </div>
                <div class="flex items-center justify-end space-x-3">
                    <button class="form-btn-dashboard mt-0">Submit</button>
                    <button class="btn-cancel mt-0">Clear</button>
                </div>
            </div>
        </form> -->
        <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
            <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                <h3 class="font-semibold text-lg mb-3">Total Scanned</h3>
                <h1 class="font-bold text-gray-900 text-6xl">68</h1>
            </div>
            <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                <h3 class="font-semibold text-lg mb-3">Duplicate Scanned</h3>
                <h1 class="font-bold text-gray-900 text-6xl">140</h1>
            </div>
        </div>
    </div>
</template>
