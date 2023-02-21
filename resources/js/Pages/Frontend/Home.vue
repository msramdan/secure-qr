<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>
<template>
  <div class="w-3/4 mx-auto mt-10">
    <h1 class="text-3xl font-bold mt-10 text-center">Selamat Datang di SecureTag</h1>
    <div class="flex justify-center mt-10">
      <Link :href="route('partner.register')" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Register</Link>
      <Link :href="route('partner.login')" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 ml-4">Login</Link>
    </div>
</div>
</template>