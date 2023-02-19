<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import FilterData from '@/Components/FilterData.vue'
import BarChart from '@/Components/BarChart.vue'
import ChartByCity from '@/Components/Partner/ChartByCity.vue'
import TotalScanMap from '@/Components/TotalScanMap.vue'
import DashboardStatCard from '@/Components/DashboardStatCard.vue'

const props = defineProps({
    dataByCity: Array,
    dataMap: Array,
    chartByKategori: Array,
    chartByBisnis: Array,
    allScan: Array,
    duplicateScan: Array
})
const byCityData = ref(props.dataByCity)

const datas = ref(props.dataMap)

const chartByKategoriData = ({
    labels: props.chartByKategori[0],
    datasets: [{
        label: 'Total Scan',
        data: props.chartByKategori[1],
        backgroundColor: [
            '#7CB5EC',
            '#434348',
        ]
    }]
})
const chartByBisnisData = ({
    labels: props.chartByBisnis[0],
    datasets: [{
        label: 'Total Scan',
        data: props.chartByBisnis[1],
        backgroundColor: ['#7CB5EC', '#434348', '#90ED7D', '#F7A35C', '#8085E9', '#F15C80', '#E4D354', '#2B908F', '#F45B5B']
    }]
})

</script>

<template>

    <Head title="Dashboard" />

    <PartnerLayout>
        <div class="flex space-x-5 overflow-x-auto snap-proximity snap-x mb-8">
            <template v-for="data, i in byCityData" :key="i">
            <div class="snap-always snap-start">
                <ChartByCity :city="data.city" :data="data.data" :color="data.color"/>
            </div>
            </template>
        </div>

        <!-- <div class="card-dashboard mb-8">
            <h2 class="card-title-dashboard">Filter Data</h2>
            <form class="form mb-5" action="#">
                <div
                    class="w-full flex flex-col md:flex-row md:items-end space-x-0 md:space-x-5 space-y-5 md:space-y-0">
                    <div class="md:w-56">
                        <label for="" class="form-label-dashboard">Start Date</label>
                        <input type="date" class="form-input-dashboard">
                    </div>
                    <div class="md:w-56">
                        <label for="" class="form-label-dashboard">End Date</label>
                        <input type="date" class="form-input-dashboard">
                    </div>
                    <div class="flex items-center justify-end space-x-3">
                        <button class="form-btn-dashboard mt-0">Submit</button>
                        <button class="btn-cancel mt-0">Clear</button>
                    </div>
                </div>
            </form>
            <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
                <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                    <h3 class="font-semibold text-lg mb-3">Total Scanned</h3>
                    <h1 class="font-bold text-6xl">{{ allScan }}</h1>
                </div>
                <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                    <h3 class="font-semibold text-lg mb-3">Duplicate Scanned</h3>
                    <h1 class="font-bold text-6xl">{{ duplicateScan != '' ? duplicateScan[0].total_duplicates : 0 }}</h1>
                </div>
            </div>
        </div> -->
        <FilterData />
        <TotalScanMap :datas="datas" />

        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="flex-1">
                <BarChart title="Chart by Kategori" :chart-data="chartByKategoriData" />
            </div>
            <div class="flex-1">
                <BarChart title="Chart by Bisnis" :chart-data="chartByBisnisData" />
            </div>
        </div>

    </PartnerLayout>
</template>
