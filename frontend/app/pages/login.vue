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
            auth.setLoading(false);
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
                <FieldsInput
                label="Email Address"
                placeholder="Enter email address"
                autocomplete="email"
                v-model="form.email"
                :error="errors?.email?.[0]"
                :errorCondition="!authSecure.disable"/>

                <FieldsInput
                label="Password"
                type="password"
                placeholder="Enter your password"
                autocomplete="password"
                v-model="form.password"
                :error="errors?.password?.[0]"/>

                <div class="flex items-center justify-between">
                    <FieldsSubmitButton
                    text="Login"
                    :loading="auth.loadding"
                    :disabled="authSecure.disable"
                    loadingText="Processing"/>
                    <nuxtLink to="password/forgot" class="text-sm text-blue-500 hover:underline">
                        Forgot Your Password?
                    </nuxtLink>
                </div>
            </form>
        </div>
    </div>
</template>