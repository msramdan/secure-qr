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
    <div v-if="openModal" @click="closeModal" class="fixed inset-0 bg-black bg-opacity-40 p-5 z-50">
        <div class="md:flex md:items-center md:justify-center h-full">
            <div class="w-full md:w-1/3 h-full">
                <div class="bg-white px-5 rounded-xl max-h-full overflow-y-auto" @click.stop>
                    <div v-show="modalTitle" class="sticky top-0 bg-white pt-5 pb-6 font-semibold text-lg">{{ modalTitle }}</div>
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
