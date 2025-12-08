<script setup>
import { navigateTo } from 'nuxt/app';
import { reactive, ref } from 'vue';

const auth = useAuthStore();
const authSecure = useAuthSecureStore();

const form = reactive({
    email: 'hasib@gmail.com',
    password: 'password',
});
const errors = ref({});


definePageMeta({
    title: 'Login',
    middleware: 'guest'
});

onMounted(() => {
    authSecure.resumeCountdownIfNeeded();
});

const hendleLogin = async () => {
    if(authSecure.disable === true)
        return;

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
            authSecure.loginDisable();
        }   
    }
}
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Customer Login</h2>
            <span class="form-error border py-1.5 px-1 rounded-sm my-2 " v-if="authSecure.disable">Too many login
                attempts. Please try again in {{ authSecure.countdown }} seconds.</span>
            <form @submit.prevent="hendleLogin">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input id="email" type="email" v-model="form.email" autofocus
                        class="w-full px-3 py-1.5 border rounded" autocomplete="email">
                    <span v-if="!authSecure.disable">
                        <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
                    </span>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" v-model="form.password"
                        class="w-full px-3 py-1.5 border rounded" autocomplete="new-password">
                    <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed"
                        :disabled="authSecure.disable">
                        <span class="flex justify-end items-center gap-0 relative" v-if="auth.loadding">
                            <span>Processing</span>
                            <Icon name="line-md:loading-alt-loop" class="text-4xl absolute left-1/2 -translate-x-1/2 text-pink-600" />
                        </span>
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