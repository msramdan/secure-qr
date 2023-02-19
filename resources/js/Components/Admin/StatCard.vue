<script setup>
const props = defineProps(['title', 'total', 'color'])
</script>

<template>
    <div class="card-dashboard">
        <h6 class="font-semibold text-lg mb-4">{{ title }}</h6>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-full" :class="`bg-${color}-50`">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-7 h-7" :class="`text-${color}-500`">
                        <slot />
                    </svg>
                </div>
                <div class="font-semibold text-4xl">{{ total }}</div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-10 h-10" :class="`text-${color}-500`">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
            </svg>
        </div>
    </div>
</template>
