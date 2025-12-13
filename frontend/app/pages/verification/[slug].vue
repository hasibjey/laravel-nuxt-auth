<script setup>
import { navigateTo, useNuxtApp } from 'nuxt/app';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';

const auth = useAuthStore();
const authSecure = useAuthSecureStore();
const route = useRoute();

const digits = ref(Array(5).fill(''));
const otpInputs = ref([]);
const errors = ref({});
const email = ref(null);
const interval = ref(null);
const countdown = ref(2); // in minutes
const resend = ref(true);

definePageMeta({ title: 'Forgot Password' });

onMounted(() => {
    authSecure.resumeCountdownIfNeeded();

    try {
        email.value = atob(decodeURIComponent(route.params.slug));
    } catch {
        email.value = null;
    }

    if (auth.user?.email_verified_at === null && email.value) {
        const resetPassword = usePasswordReset();
        resetPassword.verifyCode(email.value);
        console.log('Account not verified, verification code sent.');
    }

    startCountdown();
});

// Input focus handling
const moveNext = (index) => {
    if (digits.value[index].length === 1 && index < digits.value.length - 1) {
        otpInputs.value[index + 1]?.focus();
    }
};

const movePrev = (index, event) => {
    if (index > 0 && !digits.value[index] && event.key === 'Backspace') {
        otpInputs.value[index - 1]?.focus();
    }
};

// Verification
const handleVerification = async () => {
    const code = digits.value.join('');
    const { $toast } = useNuxtApp();
    const resetPassword = usePasswordReset();

    try {
        const res = await resetPassword.verification(email.value, code);

        if (res.status === 201) {
            $toast.fire({
                icon: 'warning',
                title: res._data.message,
                timer: 3000,
            });
        }

        if (res.status === 200) {
            navigateTo(`/password/reset/${btoa(email.value)}`);
            $toast.fire({
                icon: 'success',
                title: res._data.message,
                timer: 2000,
            });
        }
    } catch (error) {
        errors.value = error.data?.errors || {};
    }
};

// Countdown logic
const startCountdown = () => {
    resend.value = true;
    interval.value = setInterval(() => {
        countdown.value--;

        if (countdown.value <= 0) {
            clearInterval(interval.value);
            resend.value = false;
        }
    }, 1000);
};

// Resend code
const handleResendCode = async () => {
    const { $toast } = useNuxtApp();
    const resetPassword = usePasswordReset();

    try {
        const res = await resetPassword.verifyCode(email.value);

        if (res.status === 200) {
            countdown.value = 2;
            resend.value = true;
            startCountdown();

            $toast.fire({
                icon: 'success',
                title: 'Verification code resent. Check your inbox.',
                timer: 2000,
            });
        }
    } catch (error) {
        errors.value = error?.data?.errors || {};
    }
};
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Account Verification</h2>

            <form @submit.prevent="handleVerification">
                <div class="mb-4">
                    <label class="block text-gray-700">Verification Code</label>
                    <div class="grid grid-cols-5 gap-3">
                        <input v-for="(digit, index) in digits" :key="index" type="text" maxlength="1"
                            class="form-control text-center" v-model="digits[index]" @input="moveNext(index)"
                            @keydown.backspace="movePrev(index, $event)" ref="otpInputs" autofocus />
                    </div>
                    <span class="form-error" v-if="errors?.code?.length">{{ errors.code[0] }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed">
                        <span v-if="auth.loadding" class="flex justify-end items-center gap-0 relative">
                            <span>Processing</span>
                            <Icon name="line-md:loading-alt-loop"
                                class="text-4xl absolute left-1/2 -translate-x-1/2 text-pink-600" />
                        </span>
                        <span v-else>Verify</span>
                    </button>

                    <p v-if="resend">Resend code after {{ countdown }} minutes</p>
                    <button v-else
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed"
                        @click.prevent="handleResendCode">
                        Resend Code
                    </button>
                </div>

                <div class="text-center">
                    <button
                        class="py-1 px-7 border rounded transition-all duration-300 cursor-pointer hover:text-red-500 mt-4"
                        @click.prevent="auth.logout()">
                        Logout
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
