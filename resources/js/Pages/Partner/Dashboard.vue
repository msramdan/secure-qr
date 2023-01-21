<script setup>
import PartnerLayout from '@/Layouts/Backend/PartnerLayout.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import { ref, reactive } from 'vue'
import BarChart from '@/Components/BarChart.vue'
import DashboardMap from './DashboardMap.vue'
import DashboardStatCard from '@/Components/DashboardStatCard.vue'

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
    labels: ['PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx'],
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-y-5 md:gap-x-5 lg:gap-y-0 mb-8">
            <DashboardStatCard name="Kategori" color="purple" total="7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </DashboardStatCard>
            <DashboardStatCard name="Partner Bisnis" color="red" total="5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </DashboardStatCard>
            <DashboardStatCard name="Partner Produk" color="yellow" total="5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </DashboardStatCard>
            <DashboardStatCard name="Request QR" color="sky" total="7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
            </DashboardStatCard>
        </div>

        <div class="card-dashboard mb-8">
            <h2 class="card-title-dashboard">Filter Data</h2>
            <form class="form mb-5" action="#">
                <div class="w-full flex flex-col md:flex-row md:items-end space-x-0 md:space-x-5 space-y-5">
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

        <DashboardMap :datas="datas"/>

        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="flex-1">
                <BarChart title="Chart by Kategori" :chart-data="chartByKategoriData"/>
            </div>
            <div class="flex-1">
                <BarChart title="Chart by Bisnis" :chart-data="chartByBisnisData"/>
            </div>
        </div>

    </PartnerLayout>
</template>
