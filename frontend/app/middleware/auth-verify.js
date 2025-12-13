export default defineNuxtRouteMiddleware((to, from) => {
    const auth = useAuthStore();
    console.log(from.path);
    
    
    if (auth.user?.email_verified_at === null) {
        if (!to.path.startsWith('/verification')) {
            return navigateTo(`/verification/${btoa(auth.user.email)}`);
        }
        return;
    }

    if (from.path === '/password/forgot') {
        return;
    }


    if (to.path === '/login') {
        return navigateTo('/dashboard');
    }

    return navigateTo('/');
});
