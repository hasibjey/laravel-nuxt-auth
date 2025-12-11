<script setup>
import { navigateTo, useNuxtApp } from 'nuxt/app';
import { reactive, ref } from 'vue';

const auth = useAuthStore();
const authSecure = useAuthSecureStore();
const route = useRoute();


const digits = ref(["", "", "", "", ""]);
const otpInputs = ref([]);
const errors = ref({});
const email = ref();
const interval = ref(0);
const countdown = ref(120);
const resend = ref(true);


definePageMeta({
    title: 'Forgot password',
    middleware: 'guest'
});

onMounted(() => {
    authSecure.resumeCountdownIfNeeded();

    try {
        email.value = atob(decodeURIComponent(route.params.slug));
    } catch (e) {
        email.value = null;
    }
    
    resendCode();
});


const moveNext = (index) => {
    if (digits.value[index].length === 1 && index < 4) {
        otpInputs.value[index + 1].focus();
    }
};

const movePrev = (index) => {
    if (index > 0 && digits.value[index] === "") {
        otpInputs.value[index - 1].focus();
    }
};



const hendleVerification = async () => {
    const getCode = digits.value.join("");
    try {
        const { $toast } = useNuxtApp();
        const resetPassword = usePasswordReset();

        const res = await resetPassword.verification(email.value, getCode);
        
        if(res.status === 201) {
            $toast.fire({
                icon: 'warning',
                title: res._data.message,
                timer: 3000,
            })
        }

        if(res.status === 200) {
            navigateTo(`/password/reset/${btoa(email.value)}`);
            $toast.fire({
                icon: 'success',
                title: res._data.message,
                timer: 2000,
            })
        }

    } catch (error) {
        errors.value = error.data.errors;
    }
    
}

const resendCode = () => {
    interval.value = setInterval(() => {
        countdown.value--;

        if (countdown.value <= 0) {
            clearInterval(interval.value);
            resend.value = false;
        }
    }, 1000);
}


const hendleResendCode = async () => {
    try {
        const { $toast } = useNuxtApp();
        const resetPassword = usePasswordReset();
        
        const res = await resetPassword.verifyCode(email.value);
        
        if (res.status === 200) {
            countdown.value = 120
            resend.value = true;
            resendCode();

            $toast.fire({
                icon: 'success',
                title: 'Verification code resent. Check your inbox.',
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
            <h2 class="text-2xl font-bold mb-6 text-center">Account Verification</h2>
            <form @submit.prevent="hendleVerification">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Verification CODE</label>
                    <div class="grid grid-cols-5 gap-3">
                        <input v-for="(digit, index) in digits" :key="index" type="text" maxlength="1"
                            class="form-control text-center" v-model="digits[index]" @input="moveNext(index)"
                            @keydown.backspace="movePrev(index)" ref="otpInputs" autofocus />
                    </div>
                    <span>
                        <span class="form-error" v-if="errors?.code?.length">{{ errors.code[0] }}</span>
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed">
                        <span class="flex justify-end items-center gap-0 relative" v-if="auth.loadding">
                            <span>Processing</span>
                            <Icon name="line-md:loading-alt-loop"
                                class="text-4xl absolute left-1/2 -translate-x-1/2 text-pink-600" />
                        </span>
                        <span v-else>Verify</span>
                    </button>
                    <p v-if="resend">Resend code after {{ countdown }} minutes</p>
                    <button
                        class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 disabled:bg-blue-300 disabled:cursor-not-allowed"
                        @click.prevent="hendleResendCode" v-else>
                        Resend Code
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>