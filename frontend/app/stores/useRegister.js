import { defineStore } from 'pinia';

export const useRegisterStore = defineStore('register', {
    store: () => {
        lodding = false;
    },

    actions: {
        async registerUser(userForm) {
            try {
                const { $api } = useNuxtApp()
                const res = await $api('/register', {
                    method: 'POST',
                    body: { ...userForm }
                })

                return res;
                
            } catch (error) {
                throw error;
            }
        }
    }
})