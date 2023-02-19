<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    link: Object
})

const form = useForm({
    name: props.link.name,
    link: props.link.link_sosmed,
})
const FormUpdate = () => {
    Inertia.post(route('partner.links.update', props.link.id), {
        _method: 'patch',
        name: form.name,
        link: form.link
    })
}
</script>

<template>
    <Head title="Edit Custom Link Resmi" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Custom Link Resmi</h2>
            <form class="form-dashboard" @submit.prevent="FormUpdate">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="name" class="form-label-dashboard">Name :</label>
                            <select v-model="form.name" id="name" class="form-input-dashboard">
                                <option value="">Pilih jenis sosial media</option>
                                <option value="Instagram">Sosial Media Instagram</option>
                                <option value="Facebook">Sosial Media Facebook</option>
                                <option value="Twitter">Sosial Media Twitter</option>
                                <option value="Linkedin">Sosial Media Linkedin</option>
                                <option value="Tiktok">Sosial Media Tiktok</option>
                                <option value="Youtube">Sosial Media Youtube</option>
                                <option value="" disabled>--------------------------------</option>
                                <option value="TiktokShop">TiktokShop</option>
                                <option value="Lazada">Lazada</option>
                                <option value="Shopee">Shopee</option>
                                <option value="Tokopedia">Tokopedia</option>
                                <option value="Buka Lapak">Bukalapak</option>
                                <option value="" disabled>--------------------------------</option>
                                <option value="Whatsapp">CS Whatsapp</option>
                                <option value="Telepon">CS Telepon</option>
                            </select>
                            <InputError :message="form.errors.name" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="link" class="form-label-dashboard">Link :</label>
                            <input type="text" v-model="form.link" id="link" class="form-input-dashboard" placeholder="Link"/>
                            <InputError message="Harap menggunakan link yang benar ex(https://www.instagram.com/labelin_co)"/>
                            <InputError :message="form.errors.link" />
                        </div>
                    </div>
                </div>
                <FormButton :href="route('partner.links.index')" text="Update" />
            </form>
        </div>
    </PartnerLayout>
</template>
