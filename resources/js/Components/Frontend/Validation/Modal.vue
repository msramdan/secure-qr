<script setup>
import { ref } from 'vue'

const props = defineProps({
  openModal: Boolean,
  modalTitle: String
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
                    <div v-show="modalTitle" class="font-semibold text-lg mb-8">{{ modalTitle }}</div>
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
