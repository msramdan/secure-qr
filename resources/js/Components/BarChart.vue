<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps(['title', 'chartData'])


const chartOptions = ({
    responsive: false,
    responsiveAnimationDuration: 0,
    animation: {
        duration: 0
    },
    scales: {
        x: {
            ticks: {
                font: {
                    family: 'Urbanist'
                }
            },
            grid: {
                display: false
            }
        },
        y: {
            ticks: {
                font: {
                    family: 'Urbanist'
                }
            }
        }
    },
    plugins: {
        legend: {
            labels: {
                color: '#111827',
                font: {
                    family: 'Urbanist',
                    size: 16,
                    lineHeight: 1.5,
                    weight: 600,
                },
                boxWidth: 0
            }
        }
    }
})
</script>

<template>
    <div class="card-dashboard">
        <h2 class="card-title-dashboard">{{ title }}</h2>
        <Bar
            :id="title.replace(' ', '-')"
            class="w-full"
            :data="chartData"
            :options="chartOptions"
        />
    </div>
</template>
