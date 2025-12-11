export default defineNuxtPlugin((nuxtApp) => {
    const auth = useAuthStore();
    const authSecure = useAuthSecureStore();

    let timer
    const INACTIVITY_LIMIT = 30 * 60 * 1000

    const resetTimer = () => {
        clearTimeout(timer)
        if (auth.isAuthenticated) {
            timer = setTimeout(() => {
                auth.logout()
                authSecure.reset();
                // alert('You have been logged out due to inactivity')
            }, INACTIVITY_LIMIT)
        }
    }

    // Listen for activity events
    window.addEventListener('mousemove', resetTimer)
    window.addEventListener('keydown', resetTimer)
    window.addEventListener('click', resetTimer)
    window.addEventListener('scroll', resetTimer)
    window.addEventListener('touchstart', resetTimer)

    resetTimer()
})
