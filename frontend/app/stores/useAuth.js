import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: null,
        isAuthenticated: false,
        loadding: false,
    }),

    persist: true,


    getters: {
        getUser: (state) => state.user,
        getToken: (state) => state.token,
        getAuthenticated: (state) => state.isAuthenticated,
        getLoadding: (state) => state.loadding,
    },


    actions: {
        async login(formData) {
            this.setLodding(true);
            try {
                const { $api, $toast } = useNuxtApp();
                const res = await $api.raw('/login', {
                    method: 'POST',
                    body: { ...formData }
                });
                
                
                if(res.status === 200) {
                    
                    this.isAuthenticated = true;
                    this.token = res._data.token;
                    this.setUser(res._data.user);

                    $toast.fire({
                        icon: 'success',
                        title: 'Login successfully!',
                        timer: 1000,
                    });

                    return res;
                }

            } catch (error) {
                this.setLodding(false)
                this.isAuthenticated = false;
                throw error;
            }
        },

        setLodding(status) {
            this.loadding = status;
        },
        
        setUser(user) {
            this.user = user;
        },

        async logout() {
            const { $api, $toast } = useNuxtApp();
            const authSecure = useAuthSecureStore();

            try {
                const res = await $api.raw('/logout', {
                    method: 'POST',
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                });

                if(res.status === 200) {
                    this.$reset();
                    authSecure.reset();
                    navigateTo('/');

                    $toast.fire({
                        icon: 'success',
                        title: 'Logout successfully!',
                        timer: 1000,
                    });
                }
                
            } catch (error) {
                throw error;
            }
        },

        async userData() {
            const { $api, $toast } = useNuxtApp();

            try {
                const res = await $api.raw('/user', {
                    method: 'POST',
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    },
                    body:{
                        email: this.user?.email
                    }
                });

                if(res.status === 200) {
                    this.user = res._data.user;
                }
                
            } catch (error) {
                throw error;
            }
        }
    }
});