<script setup>
import { navigateTo, useNuxtApp } from 'nuxt/app';
import { reactive, ref } from 'vue';

const auth = useAuthStore();
const authSecure = useAuthSecureStore();
const route = useRoute();

const form = reactive({
    email: null,
    password: null,
    password_confirmation: null
});
const errors = ref({});


definePageMeta({
    title: 'Login',
    middleware: 'guest'
});

onMounted(() => {
    authSecure.resumeCountdownIfNeeded();

    try {
        form.email = atob(decodeURIComponent(route.params.slug));
        
    } catch (e) {
        email.value = null;
    }
});

const hendlePasswordReset = async () => {
    try {
        const { $toast } = useNuxtApp();
        const resetPassword = usePasswordReset();

        const res = await resetPassword.resetPassword(form);

        if(res.status === 201) {
            $toast.fire({
                icon: 'success',
                title: res._data.message,
                timer: 2000,
            })
        }

        if(res.status === 200) {
            navigateTo('/login');
            $toast.fire({
                icon: 'success',
                title: res._data.message,
                timer: 2000,
            })
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
            <h2 class="text-2xl font-bold mb-6 text-center">Reset Password</h2>
            <form @submit.prevent="hendlePasswordReset">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email address</label>
                    <input id="email" type="email" v-model="form.email" autofocus
                        class="w-full px-3 py-1.5 border rounded" autocomplete="email" disabled>
                    <span>
                        <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
                    </span>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" v-model="form.password" autofocus
                        class="w-full px-3 py-1.5 border rounded" autocomplete="new_password">
                    <span>
                        <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
                    </span>
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" v-model="form.password_confirmation"
                        class="form-control" autocomplete="confirm_password">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed"
                        :disabled="authSecure.disable">
                        <span class="flex justify-end items-center gap-0 relative" v-if="auth.loadding">
                            <span>Processing</span>
                            <Icon name="line-md:loading-alt-loop"
                                class="text-4xl absolute left-1/2 -translate-x-1/2 text-pink-600" />
                        </span>
                        <span v-else>Reset password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>