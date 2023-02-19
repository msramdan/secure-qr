<script setup>
import { computed } from 'vue'
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps(['city', 'data', 'color'])

const chartData = ({
    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        label: 'Total Scan',
        data: props.data,
        backgroundColor: props.color
    }]
})

const totalScan = computed(() =>
    props.data.reduce((a, b) => a + b)
);

const chartOptions = ({
    responsive: false,
    responsiveAnimationDuration: 0,
    animation: {
        duration: 0
    },
    scales: {
        x: {
            display: false
        },
        y: {
            display: false,
        },
    },
    plugins: {
        legend: {
            display: false
        },
        tooltip: {
            displayColors: false
        }
    }
})

</script>

<template>
    <div class="flex-none w-72 card-dashboard">
        <h6 class="font-bold text-lg mb-4">{{ city }}</h6>
        <div class="flex items-end justify-between">
            <Bar id="chart-by-kota" class="w-32" :data="chartData" :options="chartOptions" />
            <div class="font-semibold text-4xl" :style="{ color: color }">{{ totalScan }}</div>
        </div>
    </div>
</template>
