<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

// console.log($page.props.auth.user);
const form = useForm({
    code: '',
    name: '',
    brand: '',
    logo: '',
    manufacture: '',
    video: ''
})

const FormSubmit = () => {
    form.post(route('partner.bisnis.store'));
}
</script>

<template>
    <Head title="Tambah Bisnis" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Bisnis</h2>
            <form class="form-dashboard" @submit.prevent="FormSubmit">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Code :</label>
                            <input type="text" v-model="form.code" class="form-input-dashboard" placeholder=""/>
                            <InputError :message="form.errors.code" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Brand :</label>
                            <input type="text" v-model="form.brand" class="form-input-dashboard" placeholder=""/>
                            <InputError :message="form.errors.brand" />
                        </div>
                        <div class="mb-5">
                            <label for="photo" class="form-label-dashboard">Logo :</label>
                            <label for="photo" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        {{ form.logo != '' ? form.logo.name : 'Choose file' }}
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file"  @input="form.logo = $event.target.files[0]" id="photo" class="hidden"/>
                            <InputError message="Format logo harus .png (150x200px)" />
                            <InputError :message="form.errors.logo" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Company Name :</label>
                            <input type="text" v-model="form.name" class="form-input-dashboard" placeholder=""/>
                            <InputError :message="form.errors.name" />
                        </div>
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Manufacture Address :</label>
                            <input type="text" v-model="form.manufacture" class="form-input-dashboard" placeholder=""/>
                            <InputError :message="form.errors.manufacture" />
                        </div>
                        <div class="mb-5">
                            <label for="video" class="form-label-dashboard">Video Pendek :</label>
                            <label for="video" class="block mb-2 cursor-pointer">
                                <div class="flex border border-gray-300 rounded-lg">
                                    <div class="grow text-gray-400 px-4 py-2">
                                        {{ form.video != '' ? form.video.name : 'Choose file' }}
                                    </div>
                                    <div class="flex-none bg-gray-200 rounded-r-lg text-gray-600 px-4 py-2">Browse</div>
                                </div>
                            </label>
                            <input type="file" @input="form.video = $event.target.files[0]" id="video" class="hidden"/>
                            <InputError message="Format video harus .mp4 (max:3Mb). Dikosongkan jika tidak perlu!" />
                            <InputError :message="form.errors.video" />
                        </div>
                    </div>
                </div>
                <FormButton :href="route('partner.bisnis.index')" text="Simpan" />
            </form>
        </div>
    </PartnerLayout>
</template>
