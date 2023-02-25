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
        <FilterData :alldata="allScan" :duplicate="duplicateScan"/>
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
