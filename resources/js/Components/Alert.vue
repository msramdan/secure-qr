<script setup>
import { computed } from 'vue'

const props = defineProps(['flash'])

const color = computed(() => {
    if (props.flash.success) return 'green'
    if (props.flash.danger) return 'red'
    if (props.flash.warning) return 'yellow'
    if (props.flash.info) return 'blue'
});
</script>

<template>
    <div class="fixed bottom-3 right-3 z-50">
        <div class="border px-5 py-3 shadow rounded-xl" :class="`bg-${color}-50 border-${color}-500 text-${color}-500`">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8" :class="`text-${color}-500`">
                    <template v-if="flash.success">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </template>
                    <template v-else-if="flash.danger">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </template>
                    <template v-else-if="flash.warning">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </template>
                    <template v-else-if="flash.info">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </template>
                </svg>
                <div class="font-medium" v-if="flash.success">{{ flash.success }}</div>
                <div class="font-medium" v-if="flash.danger">{{ flash.danger }}</div>
                <div class="font-medium" v-if="flash.warning">{{ flash.warning }}</div>
                <div class="font-medium" v-if="flash.info">{{ flash.info }}</div>
            </div>
        </div>
    </div>
</template>
