<script setup>
const auth = useAuthStore();
</script>

<template>
    <nav>
        <ul class="flex justify-center items-center">
            <li class="py-1 px-3 transition-all duration-300 hover:text-purple-700"><NuxtLink to="/">Home</NuxtLink></li>
            <li class="py-1 px-3 transition-all duration-300 hover:text-purple-700" v-if="!auth.getToken"><NuxtLink to="/login">Login</NuxtLink></li>
            <li class="py-1 px-3 transition-all duration-300 hover:text-purple-700" v-if="!auth.getToken"><NuxtLink to="/register">Register</NuxtLink></li>
            <li class="py-1 px-3 transition-all duration-300 hover:text-purple-700" v-if="auth.getToken"><NuxtLink to="/dashboard">Dashboard</NuxtLink></li>
            
        </ul>
    </nav>
</template>