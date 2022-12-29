<script setup>
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    links: Array,
});
</script>
<template>
    <div
        class="flex flex-wrap items-center justify-between mt-5"
        v-if="links.length > 3"
    >
        <div class="text-gray-500 mb-2 md:mb-0">
            Showing 1 to 10 of 32 entries
        </div>
        <div
            class="flex divide-x divide-purple-1100 border border-purple-1100 rounded"
            v-for="(link, index) in links"
            :key="index"
        >
            <Link :href="link.url" class="w-10 text-center px-3.5 py-1.5"  :class="{'bg-purple-1100 text-white':link.active}" v-html="link.label"/>
        </div>
    </div>
</template>
