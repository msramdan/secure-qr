<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import BarChart from '@/Components/BarChart.vue'
import ChartByCity from '@/Components/Partner/ChartByCity.vue'
import TotalScanMap from '@/Components/TotalScanMap.vue'
import DashboardStatCard from '@/Components/DashboardStatCard.vue'

const byCityData = ref([
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#ef4444'},
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#22c55e'},
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#3b82f6'},
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#a855f7'},
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#eab308'},
    {city: 'Bandung', data: [100, 59, 80, 81, 56, 55, 150, 20, 10, 60, 90, 60], color: '#14b8a6'},
])

const datas = ref([
    { city: 'Kota Sorong', totalScan: 501 },
    { city: 'Makassar', totalScan: 1100 },
    { city: 'Bandung', totalScan: 600 },
    { city: 'Jakarta Pusat', totalScan: 10 },
])

const chartByKategoriData = ({
    labels: ['Dokumen', 'Kosmetik'],
    datasets: [{
        label: 'Total Scan',
        data: [5, 68],
        backgroundColor: [
            '#7CB5EC',
            '#434348',
        ]
    }]
})

const chartByBisnisData = ({
    labels: ['PT A', 'PT B', 'PT C', 'PT D', 'PT E', 'PT F', 'PT G', 'PT H', 'PT I'],
    datasets: [{
        label: 'Total Scan',
        data: [7, 2, 4, 4, 9, 1, 9, 3, 1],
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

        <div class="card-dashboard mb-8">
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
                    <h1 class="font-bold text-6xl">68</h1>
                </div>
                <div class="flex-1 text-center border border-gray-300 rounded-xl p-4">
                    <h3 class="font-semibold text-lg mb-3">Duplicate Scanned</h3>
                    <h1 class="font-bold text-6xl">140</h1>
                </div>
            </div>
        </div>

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
