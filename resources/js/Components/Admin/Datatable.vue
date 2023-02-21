<script setup>
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, watch } from 'vue';
import debounce from 'lodash/debounce';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    paginationLinks: Object,
    filters: Object
})
const getPaginate = (event) => {
     let selectedOption = event.target.value;
    Inertia.get(props.paginationLinks.path, {paginate: selectedOption})
}
let search = ref(props.filters.search);
watch(search, debounce(function (value) {
    Inertia.get(props.paginationLinks.path, { search: value }, { preserveState: true, replace: true })
}), 300);
</script>

<template>
    <div>
        <div class="flex flex-wrap items-center md:justify-between mb-5">
            <div class="flex items-center space-x-2 mb-2 md:mb-0">
                <div>Show</div>
                <select class="form-input-dashboard w-20" @change="getPaginate($event)">
                        <option :value="10" :selected="paginationLinks.per_page == 10">10</option>
                        <option :value="25" :selected="paginationLinks.per_page == 25">25</option>
                        <option :value="50" :selected="paginationLinks.per_page == 50">50</option>
                        <option :value="100" :selected="paginationLinks.per_page == 100">100</option>
                </select>
                <div>entries</div>
            </div>
            <div class="w-full md:w-auto">
                <input
                    type="text"
                    v-model="search"
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
