<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="md:bg-main md:pt-12 md:px-16 min-h-screen md:h-screen text-gray-900">
        <div class="bg-white h-full md:rounded-t-xl">
            <div class="flex flex-wrap-reverse md:flex-nowrap h-full">
                <div class="md:flex-1 w-full h-full overflow-y-auto">
                    <div class="flex items-center h-full p-5 md:px-16 md:py-10">
                        <slot/>
                    </div>
                </div>
                <div class="md:flex-1 w-full h-full mb-5 md:mb-0">
                    <slot name="image"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
