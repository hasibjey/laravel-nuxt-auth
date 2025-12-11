import { defineStore } from 'pinia';

export const usePasswordReset = defineStore('passwordReset', {
    state: () => ({
        loadding: false
    }),


    actions: {
        async verifyCode(email) {
            try {
                const res = await $fetch.raw('http://localhost:8000/api/forgot/password', {
                    method: "POST",
                    body: { email: email }
                });

                return res;
            } catch (error) {
                throw error;
            }
        },

        async verification(email, code) {
            try {
                const res = await $fetch.raw('http://localhost:8000/api/account/verification', {
                    method: "POST",
                    body: {
                        email: email,
                        code: code
                    }
                });

                return res;
            } catch (error) {
                throw error;
            }
        },

        async verification(email, code) {
            try {
                const res = await $fetch.raw('http://localhost:8000/api/account/verification', {
                    method: "POST",
                    body: {
                        email: email,
                        code: code
                    }
                });

                return res;
            } catch (error) {
                throw error;
            }
        },

        async resetPassword(formData) {
            try {
                const res = await $fetch.raw('http://localhost:8000/api/password/reset', {
                    method: "POST",
                    body: {...formData }
                });

                return res;
            } catch (error) {
                throw error;
            }
        },


    }
});