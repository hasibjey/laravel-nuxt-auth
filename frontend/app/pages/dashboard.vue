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
    </section>
</template>