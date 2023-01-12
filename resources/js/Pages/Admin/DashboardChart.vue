<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const chart1Data = ({
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

const chart1Options = ({
    responsive: false,
    responsiveAnimationDuration: 0,
    animation: {
        duration: 0
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 80
        },
    },
    plugins: {
        legend: {
            labels: {
                font: {
                    family: "'Urbanist'",
                    size: 16,
                    lineHeight: 1.5
                }
            }
        }
    },
    responsive: true
})

const chart2Data = ({
    labels: ['PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx', 'PT xxx'],
    datasets: [{
        label: 'Total Scan',
        data: [7, 2, 4, 4, 9, 1, 9, 3, 1],
        backgroundColor: ['#7CB5EC', '#434348', '#90ED7D', '#F7A35C', '#8085E9', '#F15C80', '#E4D354', '#2B908F', '#F45B5B']
    }]
})

const chart2Options = ({
    responsive: false,
    responsiveAnimationDuration: 0,
    animation: {
        duration: 0
    },
    scales: {
        y: {
            beginAtZero: true,
            max: 10
        },
    },
    plugins: {
        legend: {
            labels: {
                font: {
                    family: "'Urbanist'",
                    size: 16,
                    lineHeight: 1.5
                }
            }
        }
    },
    responsive: true
})

</script>

<template>
    <div class="flex flex-col lg:flex-row lg:space-x-8 space-y-8 lg:space-y-0">
        <div class="flex-1">
            <div class="card-dashboard">
                <h2 class="card-title-dashboard">Chart by Kategori</h2>
                <Bar
                    id="by-category-chart"
                    class="w-full"
                    :options="chart1Options"
                    :data="chart1Data"
                />
            </div>
        </div>
        <div class="flex-1">
            <div class="card-dashboard">
                <h2 class="card-title-dashboard">Chart by Bisnis</h2>
                <Bar
                    id="by-category-chart"
                    class="w-full"
                    :options="chart2Options"
                    :data="chart2Data"
                />
            </div>
        </div>
    </div>
</template>
