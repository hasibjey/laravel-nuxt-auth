export default defineNuxtPlugin(() => {
    const config = useRuntimeConfig()

    const api = $fetch.create({
        baseURL: 'http://localhost:8000/api',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
        }
    })

    return {
        provide: {
            api
        }
    }
})
