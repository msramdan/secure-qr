<script setup>
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['paginationLinks'])
</script>

<template>
    <div>
        <div class="flex flex-wrap items-center md:justify-between mb-5">
            <div class="flex items-center space-x-2 mb-2 md:mb-0">
                <div>Show</div>
                <select class="form-input-dashboard w-20">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <div>entries</div>
            </div>
            <div class="w-full md:w-auto">
                <input
                    type="text"
                    class="form-input-dashboard"
                    placeholder="Search"
                />
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <slot/>
        </div>
        <Pagination :data="paginationLinks"/>
    </div>
</template>
