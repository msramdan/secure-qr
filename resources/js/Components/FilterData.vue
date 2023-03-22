<script setup>
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue'

const openFilerOption = ref(false)
const props = defineProps({
    alldata: Array,
    duplicate: Array
})

const { url } = usePage()
const filter = (e) => {
    Inertia.get(url.value, {filter: e})
}
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
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer mb-2" @click="filter('weekly')">Weekly</li>
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer mb-2"  @click="filter('monthly')">Monthly</li>
                        <li class="text-purple-1000 hover:text-purple-1100 hover:cursor-pointer"  @click="filter('yearly')">Yearly</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
            <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                <h3 class="font-semibold text-lg mb-3">Total Scanned</h3>
                <h1 class="font-bold text-gray-900 text-6xl">{{ alldata != '' ? alldata[0] : 0 }}</h1>
            </div>
            <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                <h3 class="font-semibold text-lg mb-3">Duplicate Scanned</h3>
                <h1 class="font-bold text-gray-900 text-6xl">{{ duplicate != '' ? duplicate[0].total_duplicates: 0 }}</h1>
            </div>
        </div>
    </div>
</template>
