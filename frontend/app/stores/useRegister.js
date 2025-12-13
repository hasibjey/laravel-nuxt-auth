import { defineStore } from 'pinia';

export const useRegisterStore = defineStore('register', {
    store: () => {
        loading = false;
    },

    actions: {
        async registerUser(userForm) {
            this.loading = true;
            try {
                const { $api } = useNuxtApp()
                const res = await $api.raw('/register', {
                    method: 'POST',
                    body: { ...userForm }
                })

                console.log(res);
                
                return res;
                
            } catch (error) {
                throw error;
            }
        }
    }
})