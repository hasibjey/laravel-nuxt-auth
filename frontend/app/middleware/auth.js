export default defineNuxtRouteMiddleware((to, from) => {
    const auth = useAuthStore();

    if (!auth.isAuthenticated) {
        return navigateTo('/');
    }

    if (auth.user?.email_verified_at === null) {
        return navigateTo(`/verification/${btoa(auth.user.email)}`);
    }

    if (to.path === '/login') {
        return navigateTo('/dashboard');
    }
});
