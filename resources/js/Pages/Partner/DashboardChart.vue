<script setup>
import BarChart from '@/Components/BarChart.vue';

const chartByKategoriData = ({
    labels: ['PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx'],
    datasets: [{
        label: 'Total Scan',
        data: [7, 2, 4, 4, 9, 1, 9, 3, 1],
        backgroundColor: ['#7CB5EC', '#434348', '#90ED7D', '#F7A35C', '#8085E9', '#F15C80', '#E4D354', '#2B908F', '#F45B5B']
    }]
})

const chartByBisnisData = ({
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

</script>

<template>
    <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
        <div class="flex-1">
            <div class="card-dashboard">
                <h2 class="card-title-dashboard">Chart by Kategori</h2>
                <BarChart :chart-data="chartData" :chart-options="chartOptions"/>
            </div>
        </div>
        <div class="flex-1">
            <div class="card-dashboard">
                <h2 class="card-title-dashboard">Chart by Bisnis</h2>
                <!-- <Bar
                    id="by-category-chart"
                    class="w-full"
                    :options="chart2Options"
                    :data="chart2Data"
                /> -->
            </div>
        </div>
    </div>
</template>
