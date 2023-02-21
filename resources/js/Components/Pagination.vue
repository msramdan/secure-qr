<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from 'vue';

const props = defineProps({
    data: Array,
});
</script>
<template>
    <div
        class="flex flex-wrap justify-between items-center mt-5"
        v-if="data.links.length > 3"
    >
        <div class="text-gray-500 mb-2 md:mb-0">
            Showing {{ data.from }} to {{ data.to }} of {{ data.total }} entries
        </div>
        <div
            class="flex divide-x divide-purple-1100 border border-purple-1100 rounded overflow-x-auto"
        >
            <Link v-for="(link, index) in data.links"
            :key="index" :href="link.url" class="min-w-max text-center px-3.5 py-1.5 truncate" :class="{'bg-purple-1100 text-white': link.active, 'w-10': /[0-9]/.test(link.label)}" v-html="link.label"/>
        </div>
    </div>
</template>
