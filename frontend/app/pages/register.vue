<script setup>
import { ref, reactive } from 'vue';

const form = reactive({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
});

const errors = ref({});

const handleRegister = async () => {
    try {
        const { $toast } = useNuxtApp();
        const registerStore = useRegisterStore();
        errors.value = {};

        const response = await registerStore.registerUser(form);

        form.name = null,
        form.email = null,
        form.password = null,
        form.password_confirmation = null

        $toast.fire({
            icon: 'success',
            title: response?.message || 'Registration successful',
            timer: 1000,
        });

        navigateTo('/login');

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
            <h2 class="text-2xl font-bold mb-6 text-center">Customer Registration</h2>
            <form @submit.prevent="handleRegister">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input id="name" type="text" v-model="form.name" autofocus class="form-control"
                        :class="(errors.name ? ' border-red-600' : '')" autocomplete="name">
                    <span class="form-error" v-if="errors.name">{{ errors.name[0] }}</span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input id="email" type="email" v-model="form.email" class="form-control"
                        :class="(errors.name ? ' border-red-600' : '')" autocomplete="email">
                    <span class="form-error" v-if="errors.email">{{ errors.email[0] }}</span>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" v-model="form.password" class="form-control"
                        :class="(errors.name ? ' border-red-600' : '')" autocomplete="new-password">
                    <span class="form-error" v-if="errors.password">{{ errors.password[0] }}</span>
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" v-model="form.password_confirmation"
                        class="form-control" autocomplete="confirm_password">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Register
                    </button>
                    <NuxtLink to="/login" class="text-sm text-blue-500 hover:underline">
                        Already registered? Login here.
                    </NuxtLink>
                </div>
            </form>
        </div>
    </div>
</template>