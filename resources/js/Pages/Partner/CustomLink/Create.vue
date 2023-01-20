<script setup>
import PartnerLayout from "@/Layouts/Backend/PartnerLayout.vue";
import FormButton from "@/Components/Admin/FormButton.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Tambah Custom Link Resmi" />

    <PartnerLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Tambah Custom Link Resmi</h2>
            <form class="form-dashboard">
                <div class="flex flex-col lg:flex-row lg:space-x-8">
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Name :</label>
                            <select name="" id="" class="form-input-dashboard">
                                <option value="">Pilih jenis sosial media</option>
                            </select>
                            <InputError message="" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-5">
                            <label for="" class="form-label-dashboard">Link :</label>
                            <input type="text" class="form-input-dashboard" placeholder="Link"/>
                            <InputError message="Harap menggunakan link yang benar ex(https://www.instagram.com/labelin_co)"/>
                            <InputError message="" />
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Simpan" />
            </form>
        </div>
    </PartnerLayout>
</template>
