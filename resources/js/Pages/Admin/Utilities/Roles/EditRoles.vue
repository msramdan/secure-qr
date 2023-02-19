<script setup>
import AdminLayout from '@/Layouts/Backend/AdminLayout.vue';
import FormButton from '@/Components/Admin/FormButton.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="Edit Role"/>

    <AdminLayout>
        <div class="card-dashboard">
            <h2 class="card-title-dashboard">Edit Role</h2>
            <form class="form-dashboard" action="#">
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Nama Role :</label>
                    <input type="text" name="" class="form-input-dashboard" placeholder="Super Admin">
                </div>

                <!-- Permissions -->
                <div class="mb-5">
                    <label for="" class="form-label-dashboard">Role Permission :</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        <!-- User Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">User</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>user_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>user_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>user_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>user_delete</span>
                                </div>
                            </div>
                        </div>

                        <!-- Role Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Role</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>role_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>role_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>role_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>role_delete</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>role_detail</span>
                                </div>
                            </div>
                        </div>

                        <!-- Category Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Category</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>category_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>category_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>category_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>category_delete</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>category_detail</span>
                                </div>
                            </div>
                        </div>

                        <!-- Partner Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Partner</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>partner_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>partner_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>partner_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>partner_delete</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>partner_detail</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>bussiness_partner</span>
                                </div>
                            </div>
                        </div>


                        <!-- Product Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Product</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>product_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>product_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>product_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>product_delete</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>product_detail</span>
                                </div>
                            </div>
                        </div>

                        <!-- Type QR Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Type QR</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>type_qr_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>type_qr_create</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>type_qr_update</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>type_qr_delete</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>type_qr_detail</span>
                                </div>
                            </div>
                        </div>

                        <!-- Request QR Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Request QR</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>request_qr_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>request_qr_detail</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>update_status</span>
                                </div>
                            </div>
                        </div>

                        <!-- Setting Web Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Setting Web</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>setting_web_show</span>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>setting_web_update</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak Permission -->
                        <div class="p-3 border border-gray-300 rounded-lg">
                            <label for="" class="form-label-dashboard">Kontak</label>
                            <div class="space-y-0.5">
                                <div>
                                    <input type="checkbox" name="" id="" class="rounded mr-2">
                                    <span>kontak_show</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <FormButton href="#" text="Update"/>
            </form>
        </div>
    </AdminLayout>
</template>
