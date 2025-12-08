<script setup>
const auth = useAuthStore();

definePageMeta({
    title: 'Dashboard',
    middleware: 'auth'
});

</script>


<template>
    <section class="text-center">
        <h1 class="font-bold text-4xl italic mt-20">Welcome to <span class="capitalize">{{ auth.user?.name }}</span></h1>
        <p class="text-gray-700">{{ auth.user?.email }}</p>


        <button class="py-1 px-7 border rounded transition-all duration-300 cursor-pointer hover:text-red-500 mt-4"
        @click.prevent="auth.logout()">
            Logout
        </button>
    </section>
</template>