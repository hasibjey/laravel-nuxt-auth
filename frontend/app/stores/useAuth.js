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
                    
                    this.token = res._data.token;
                    this.setUser(res._data.user);
                    this.isAuthenticated = true;

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
    }
});