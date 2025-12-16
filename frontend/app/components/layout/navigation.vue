<script setup>
const auth = useAuthStore();
</script>

<template>
    <nav class="py-3">
        <ul class="nav-group">
            <li class="nav-item">
                <NuxtLink to="/" class="nav-link">Home</NuxtLink>
            </li>
            <li class="nav-item" v-if="!auth.isAuthenticated">
                <NuxtLink to="/login" class="nav-link">Login</NuxtLink>
            </li>
            <li class="nav-item" v-if="!auth.isAuthenticated">
                <NuxtLink to="/register" class="nav-link">Register</NuxtLink>
            </li>
            <li class="nav-item" v-if="auth.isAuthenticated">
                <NuxtLink to="/dashboard" class="nav-link">Dashboard</NuxtLink>
            </li>
            <li class="nav-item group" v-if="auth.isAuthenticated">
                <button class="flex justify-center items-center gap-1 cursor-pointer">
                    <img :src="`https://ui-avatars.com/api/?name=${auth?.user.name}`" :alt="auth?.user.name" class="rounded-full w-6 h-6">
                    {{ auth?.user.name }}
                </button>

                <ul class="nav-sub-group hidden group-hover:block">
                    <li class="nav-sub-item">
                        <NuxtLink to="/profile" class="nav-sub-link">Profile</NuxtLink>
                    </li>
                    <li class="nav-sub-item">
                        <NuxtLink class="nav-sub-link" @click.prevent="auth.logout()">Logout</NuxtLink>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>