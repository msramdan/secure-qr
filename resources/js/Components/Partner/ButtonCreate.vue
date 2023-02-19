<script setup>
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps(['href'])
</script>

<template>
    <Link :href="href">
        <button class="bg-green-50 hover:bg-green-100 text-green-500 px-4 py-2 rounded-lg font-medium flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-0.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
            </svg>
            <span>Tambah</span>
        </button>
    </Link>
</template>
