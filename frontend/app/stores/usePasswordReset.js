import { defineStore } from 'pinia';

export const usePasswordReset = defineStore('passwordReset', {
    state: () => ({
        loading: false
    }),

    actions: {
        async verifyCode(email) {
            this.loading = true;
            try {
                return await $fetch.raw('http://localhost:8000/api/forgot/password', {
                    method: "POST",
                    body: { email }
                });
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async verification(email, code) {
            this.loading = true;

            try {
                const res = await $fetch.raw('http://localhost:8000/api/account/verification', {
                    method: "POST",
                    body: { email, code }
                });

                const auth = useAuthStore();
                const { $toast } = useNuxtApp();
                
                if (auth.isAuthenticated) {
                    await $fetch.raw('http://localhost:8000/api/account/verify', {
                        method: "POST",
                        body: { email },
                        headers: {
                            Authorization: `Bearer ${auth.token}`
                        }
                    });

                    if (res.status === 201) {
                        $toast.fire({
                            icon: 'warning',
                            title: res._data.message,
                            timer: 3000,
                        });
                    }
    
                    if (res.status === 200) {
                        $toast.fire({
                            icon: 'success',
                            title: 'User Verified Successfully',
                            timer: 3000,
                        });
                        
                        if (auth.isAuthenticated) {
                            await auth.userData();
                        }
                        
                        setTimeout(() => navigateTo('/dashboard'), 600);
                    }

                }
                

                return res;

            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        },

        async resetPassword(formData) {
            this.loading = true;

            try {
                return await $fetch.raw('http://localhost:8000/api/password/reset', {
                    method: "POST",
                    body: { ...formData }
                });
            } catch (error) {
                throw error;
            } finally {
                this.loading = false;
            }
        }
    }
});
