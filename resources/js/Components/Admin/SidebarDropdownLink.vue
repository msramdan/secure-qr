<script setup>
import { computed, defineEmits, defineProps } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'name', 'openedMenu', 'active']);

const classes = computed(() =>
    props.active
        ? 'bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 pl-5 py-3 text-white rounded-r-2xl cursor-pointer my-1'
        : 'pl-5 py-3 text-purple-1000 hover:text-purple-1100 cursor-pointer my-1'
);

const emit = defineEmits(['handleOpenMenu']);

function openMenu() {
    emit('handleOpenMenu');
}
</script>

<template>
    <li class="group cursor-pointer text-purple-1000 mb-1">
        <div @click="openMenu" class="px-5 py-3 group-hover:text-purple-1100" :class="{ 'bg-gradient-to-r from-purple-dashboard-gradient-1 to-purple-dashboard-gradient-2 text-white group-hover:text-white rounded-tr-2xl ': openedMenu == name || active }">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="flex-none w-5 h-5">
                    <slot name="icon"/>
                </svg>
                <div class="grow flex items-center justify-between">
                    <span class="font-medium">{{ name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ease-out duration-300" :class="[ openedMenu == name || active ? 'rotate-90' : 'rotate-0' ]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
        </div>
        <Transition
            enter-from-class="scale-y-0 -translate-y-1/2"
            enter-active-class="transition ease-in-out duration-500"
            enter-to-class="scale-100 translate-y-0"
        >
            <ul v-if="openedMenu == name || active" class="bg-[#EFEEFD] pl-5 py-1.5 rounded-br-2xl">
                <slot/>
            </ul>
        </Transition>
    </li>
</template>
