<script setup>
import { ref } from 'vue'

const props = defineProps({
  openModal: Boolean
});

const emit = defineEmits(['closeModal']);

function closeModal() {
    emit('closeModal');
}
</script>

<template>
    <div v-if="openModal" @click="closeModal" class="fixed inset-0 bg-black bg-opacity-40 p-5">
        <div class="flex items-center justify-center h-full">
            <div class="w-[400px] px-5">
                <div class="bg-white p-5 rounded-xl" @click.stop>
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
