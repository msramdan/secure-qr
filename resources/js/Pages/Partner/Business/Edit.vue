<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    business: Object,
    videos: Object
});
const form = useForm({
    code: props.business.code,
    brand: props.business.brand,
    name: props.business.name,
    manufacture: props.business.manufacture,
    logo: '',
    video: '',
})
const ForomUpdate = () => {
    Inertia.post(route('partner.bisnis.update', props.business.id), {
        _method: 'patch',
      code: form.code,  
      brand: form.brand,  
      name: form.name,  
      manufacture: form.manufacture,  
      logo: form.logo,  
      video: form.video,  
    })
}
</script>

<template>
    <Head title="Edit Bisnis" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Bisnis</h2>
            <form class="form-dashboard" @submit.prevent="ForomUpdate">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Code :</label>
                            <input type="text" class="form-input-dashboard" placeholder="" v-model="form.code"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Brand :</label>
                            <input type="text" class="form-input-dashboard" placeholder="" v-model="form.brand"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="logo" class="form-label-dashboard">Logo :</label>
                            <img :src="`/storage/uploads/logos/` + business.logo" alt="Logo" class="w-full md:w-48 rounded mb-2"/>
                            <label for="logo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.logo = $event.target.files[0]" id="logo" class="hidden"/>
                            <InputError message="Format logo harus .png (150x200px)" />
                            <InputError message="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Company Name :</label>
                            <input type="text" class="form-input-dashboard" placeholder="" v-model="form.name"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Manufacture Address :</label>
                            <input type="text" class="form-input-dashboard" placeholder="" v-model="form.manufacture"/>
                            <InputError message="" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Video :</label>
                            <video class="w-full max-h-64 rounded mb-2" controls>
                                <source :src="`/storage/uploads/videos/` + videos.video" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <label for="video" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        Choose file
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.video = $event.target.files[0]" id="video" class="hidden"/>
                            <InputError message="Format video harus .mp4 (max:3Mb)" />
                            <InputError message="" />
                        </div>
                    </div>
                </div>
                <FormButton :href="route('partner.bisnis.index')" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
