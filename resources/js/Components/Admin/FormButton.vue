<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'text']);
</script>

<template>
    <div class="flex items-center space-x-2 font-medium mt-8">
        <Link :href="href">
            <button class="bg-red-50 hover:bg-red-100 text-red-500 px-4 py-2 rounded-lg">Kembali</button>
        </Link>
        <button type="submit" class="btn-primary">{{ text }}</button>
    </div>
</template>
