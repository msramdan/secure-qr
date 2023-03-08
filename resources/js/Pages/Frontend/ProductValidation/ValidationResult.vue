<script setup>
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import ProductRegistered from './Partials/ProductRegistered.vue'
import SerialNumberNotRegistered from './Partials/SerialNumberNotRegistered.vue'
import SerialNumberDuplicate from './Partials/SerialNumberDuplicate.vue'
import { ref } from 'vue'

const props = defineProps({
    product_status: String,
    product: Object,
    sosmed: Object,
    product_rate: Object,
    status: Boolean,
    loyalty: Boolean,
    sn: String
})
const result = ref(props.product_status)
</script>

<template>
    <Head title="Hasil Validasi"/>
    <ProductRegistered :product="product" :sosmed="sosmed" :product_rate="product_rate" :status="status" :loyalty="loyalty" v-if="result == 'registered'"/>
    <SerialNumberNotRegistered :sn="sn" v-if="result == 'not registered'"/>
    <SerialNumberDuplicate :sn="sn" v-if="result == 'duplicate'"/>
</template>

<style scoped>
.form-input-pin {
    @apply w-9 border border-gray-300 text-center rounded placeholder-gray-400 focus:outline-none;
}

.badge {
    @apply flex-none bg-[#EBF0FF] flex items-center justify-center w-5 h-5 rounded-md mt-1 font-bold text-sm text-[#3366FF];
}
</style>
