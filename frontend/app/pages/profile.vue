<script setup>
    import { reactive, ref } from 'vue';

    definePageMeta({
        title: 'Profile',
        middleware: 'auth'
    });

    const auth = useAuthStore();
    const form = reactive({
        name: auth?.user.name,
        email: auth?.user.email,
        old_password: 'password',
        password: 'password',
        password_confirmation: 'password'
    });
    const error = ref({});


    const handleProfileupdate = async () => {
        try {
            const { $api, $toast } = useNuxtApp();
            const auth = useAuthStore();
            const res = await $api.raw('http://127.0.0.1:8000/api/user/update', {
                method: 'POST',
                headers: {
                    Authorization: `Bearer ${auth.token}`
                },
                body: { ...form }
            });

            auth.setUser(res._data.user);

            if (res.status === 200) {
                error.value = null;
                await $toast.fire({
                    icon: 'success',
                    title: res._data.message,
                    timer: 1500,
                });
            }

        } catch (error) {
            if (error.data?.errors) {
                error.value = error.data.errors;
            }

        }
    }

    const handleChangePassword = async () => {
        try {
            const { $api, $toast } = useNuxtApp();
            const auth = useAuthStore();
            const res = await $api.raw('http://127.0.0.1:8000/api/user/password/change', {
                method: 'POST',
                headers: {
                    Authorization: `Bearer ${auth.token}`
                },
                body: { ...form }
            });

            if(res.status === 200) {
                error.value = null;
                auth.logout(res._data.message);
            }
            
        } catch (error) {
            if (error.data?.errors) {
                error.value = error.data.errors;
            }
            
        }
    }



</script>


<template>
    <section class="grid grid-cols-2 gap-4 p-3">
        <div class="border border-gray-300 rounded p-4 shadow">
            <h2 class="border-b border-gray-400 py-1 mb-3">Profile information</h2>
            <form @submit.prevent="handleProfileupdate">
                <FieldsInput
                label="Name"
                placeholder="Enter your name"
                autocomplete="name"
                v-model="form.name"
                :error="error?.name?.[0] || ''"
                />

                <FieldsInput
                label="Email Address"
                placeholder="Enter your name"
                autocomplete="email"
                v-model="form.email"
                :error="error?.email?.[0] || ''"
                :disabled="true"
                />

                <div class="flex justify-between mt-7">
                    <FieldsSubmitButton
                    text="Update"
                    loadingText="Processing"
                    class="bg-yellow-400 !text-black text-sm hover:bg-yellow-500" />
                </div>
            </form>
        </div>

        <div class="border border-gray-300 rounded p-4 shadow">
            <h2 class="border-b border-gray-400 py-1 mb-3">Change your password</h2>
            <form @submit.prevent="handleChangePassword">
                <FieldsInput
                label="email"
                type="email"
                autocomplete="email"
                v-model="form.email"
                class="hidden" />

                <FieldsInput
                label="Old password"
                type="password"
                placeholder="Enter your old password"
                autocomplete="current-password"
                v-model="form.old_password"
                :error="error?.old_password?.[0] || ''" />

                <FieldsInput 
                label="Password" 
                type="password" 
                placeholder="Enter your new password"
                autocomplete="new-password"
                v-model="form.password"
                :error="error?.password?.[0] || ''" />

                <FieldsInput 
                label="Confirm Password" 
                type="password" 
                placeholder="Enter confirm password"
                autocomplete="confirm-password"
                v-model="form.password_confirmation"/>

                <div class="flex justify-between mt-7">
                    <FieldsSubmitButton
                    text="Change"
                    loadingText="Processing"
                    class="text-sm"/>
                </div>
            </form>
        </div>
    </section>
</template>