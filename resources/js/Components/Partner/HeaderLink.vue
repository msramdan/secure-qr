<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'name', 'active']);

const classes = computed(() =>
    props.active
        ? 'text-purple-1100 cursor-pointer'
        : 'text-purple-1000 hover:text-purple-1100 cursor-pointer'
);
</script>

<template>
    <Link :href="href">
        <li :class="classes">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <slot/>
                </svg>
                <span class="font-medium truncate">{{ name }}</span>
            </div>
        </li>
    </Link>
</template>
