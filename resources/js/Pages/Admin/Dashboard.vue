<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { ref, reactive } from 'vue'
import BarChart from '@/Components/BarChart.vue'
import TotalScanMap from '@/Components/TotalScanMap.vue'

const datas = ref([
    { city: 'Kota Sorong', totalScan: 501 },
    { city: 'Makassar', totalScan: 1100 },
    { city: 'Bandung', totalScan: 600 },
    { city: 'Jakarta Pusat', totalScan: 10 },
]);

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

    <AdminLayout>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-y-5 md:gap-x-5 lg:gap-y-0 mb-8">
            <div class="card-dashboard">
                <h6 class="font-semibold text-lg mb-4">Partner</h6>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-purple-50 flex items-center justify-center w-16 h-16 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="text-purple-1100 w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                            </svg>
                        </div>
                        <div class="font-semibold text-4xl">124</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-purple-1100 w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
            </div>
            <div class="card-dashboard">
                <h6 class="font-semibold text-lg mb-4">Partner Bisnis</h6>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-red-50 flex items-center justify-center w-16 h-16 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="text-red-500 w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="font-semibold text-4xl">95</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-red-500 w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
            </div>
            <div class="card-dashboard">
                <h6 class="font-semibold text-lg mb-4">Partner Produk</h6>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-50 flex items-center justify-center w-16 h-16 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="text-yellow-500 w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>

                        </div>
                        <div class="font-semibold text-4xl">252</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-yellow-500 w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
            </div>
            <div class="card-dashboard">
                <h6 class="font-semibold text-lg mb-4">Request QR</h6>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-sky-50 flex items-center justify-center w-16 h-16 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="text-sky-500 w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                            </svg>

                        </div>
                        <div class="font-semibold text-4xl">124</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-sky-500 w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                    </svg>
                </div>
            </div>
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

        <TotalScanMap :datas="datas"/>

        <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="flex-1">
                <BarChart title="Chart by Kategori" :chart-data="chartByKategoriData" />
            </div>
            <div class="flex-1">
                <BarChart title="Chart by Bisnis" :chart-data="chartByBisnisData" />
            </div>
        </div>

    </AdminLayout>
</template>
