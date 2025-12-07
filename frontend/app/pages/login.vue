<script setup>
import { navigateTo } from 'nuxt/app';
import { reactive, ref } from 'vue';

const auth = useAuthStore();

const form = reactive({
    email: 'hasib@gmail.com',
    password: 'password',
});
const errors = ref({});


definePageMeta({
    title: 'Login',
    middleware: 'guest'
});

const hendleLogin = async () => {
    try {
        const res = await auth.login(form);
        
        if(res.status === 200) {
            form.email = null;
            form.password = null;
            auth.setLodding(false);
            navigateTo('dashboard');
        }
        
    } catch (error) {
        if (error?.data?.errors) {
            errors.value = error.data.errors;
        }   
    }
}
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Customer Login</h2>
            <form @submit.prevent="hendleLogin">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input id="email" type="email" v-model="form.email" autofocus
                        class="w-full px-3 py-1.5 border rounded" autocomplete="email">
                    <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" v-model="form.password"
                        class="w-full px-3 py-1.5 border rounded" autocomplete="new-password">
                    <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <Icon name="eos-icons:bubble-loading" class="text-xl px-10 py-1" v-if="auth.getLoadding" />
                        <span v-else>Login</span>
                    </button>
                    <a class="text-sm text-blue-500 hover:underline" href="">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</template>