<script setup>
import { ref, reactive } from 'vue';

const registerStore = useRegisterStore();

const form = reactive({
    name: "user name",
    email: 'user@gmail.com',
    password: 'password',
    password_confirmation: 'password'
});

const errors = ref({});

definePageMeta({
    title: 'Register',
    middleware: 'guest'
});

const handleRegister = async () => {
    try {
        const { $toast } = useNuxtApp();
        errors.value = {};

        const res = await registerStore.registerUser(form);

        if(res.status === 200) {

            const loginForm = reactive({
                email: form.email,
                password: form.password,
            });

            form.name = null;
            form.email = null;
            form.password = null;
            form.password_confirmation = null;

            registerStore.loading = false;


            const auth = useAuthStore();
            const resLogin = await auth.login(loginForm);

            if(resLogin.status === 200) {
                auth.loading = false;
                $toast.fire({
                    icon: 'success',
                    title: res._data?.message,
                    timer: 1000,
                });
        
                navigateTo('/login');
            }
    
        }


    } catch (error) {
        if (error?.data?.errors) {
            errors.value = error.data.errors;
            registerStore.loading = false;
        }
    }

}

</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Customer Registration</h2>
            <form @submit.prevent="handleRegister">
                <FieldsInput
                label="Name"
                placeholder="Enter your name"
                autocomplete="name"
                v-model="form.name"
                :error="errors?.name?.[0]"
                autofocus="true" />
                
                <FieldsInput
                label="Email Address"
                placeholder="Enter your email address"
                autocomplete="email"
                v-model="form.email"
                :error="errors?.email?.[0]" />
                
                <FieldsInput
                label="Password"
                type="password"
                placeholder="Enter your password"
                autocomplete="new-password"
                v-model="form.password"
                :error="errors?.password?.[0]" />

                <FieldsInput
                label="Confirm Password"
                type="password"
                placeholder="Enter confirm password"
                autocomplete="new-confirm_password"
                v-model="form.password_confirmation" />

                <div class="flex items-center justify-between">
                    <fieldsSubmitButton
                    text="Register"
                    :loading="registerStore.loading"
                    loadingText="Processing"
                    />

                    <NuxtLink to="/login" class="text-sm text-blue-500 hover:underline">
                        Already registered? Login here.
                    </NuxtLink>
                </div>
            </form>
        </div>
    </div>
</template>