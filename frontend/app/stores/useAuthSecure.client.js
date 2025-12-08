import { defineStore } from 'pinia';

export const useAuthSecureStore = defineStore('authSecure', {
    state: () => ({
        attempt: 3,
        timeDuration: 120,
        attemptCount: 0,
        disable: false,
        countdown: 0,
        interval: null,
    }),

    persist: true,


    actions: {
        loginDisable() {
            this.attemptCount++;

            if (this.attemptCount >= this.attempt && !this.disable) {
                this.disable = true;
                this.countdown = this.timeDuration;

                this.countInterval();
                
            }
        },

        reset() {
            this.$reset();
        },

        resumeCountdownIfNeeded() {
            if (this.disable && this.countdown >= 0) {
                this.countInterval();
            }
        },

        countInterval() {
            this.interval = setInterval(() => {
                this.countdown--;

                if (this.countdown <= 0) {
                    clearInterval(this.interval);
                    this.disable = false;
                    this.attemptCount = 0;
                    this.reset();
                }
            }, 1000);
        },
    }
});