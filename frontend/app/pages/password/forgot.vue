<script setup>
import { navigateTo, useNuxtApp } from 'nuxt/app';
import { reactive, ref } from 'vue';

const auth = useAuthStore();
const authSecure = useAuthSecureStore();

const form = reactive({
    email: 'hasib@gmail.com',
});
const errors = ref({});


definePageMeta({
    title: 'Forgot password',
    middleware: 'guest'
});

onMounted(() => {
    authSecure.resumeCountdownIfNeeded();
});

const hendleForgotPassword = async () => {
    try {
        const { $toast } = useNuxtApp();
        const resetPassword = usePasswordReset();

        const res = await resetPassword.verifyCode(form.email);

        if(res.status === 200) {
            navigateTo(`/verification/${btoa(form.email)}`);
            errors.value = {}
            
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
            <h2 class="text-2xl font-bold mb-6 text-center">Forgot Password</h2>
            <form @submit.prevent="hendleForgotPassword">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input id="email" type="email" v-model="form.email" autofocus
                        class="form-control" autocomplete="email">
                    <span v-if="!authSecure.disable">
                        <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed">
                        <span class="flex justify-end items-center gap-0 relative" v-if="auth.loadding">
                            <span>Processing</span>
                            <Icon name="line-md:loading-alt-loop" class="text-4xl absolute left-1/2 -translate-x-1/2 text-pink-600" />
                        </span>
                        <span v-else>Reset password</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>