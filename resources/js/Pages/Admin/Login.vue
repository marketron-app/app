<template>
    <div class="card p-3 m-5 shadow-sm rounded text-center">
        <h1>Admin Login</h1>
        <form @submit.prevent="login">
            <text-input v-model="form.email" :error="form.errors.email" label="Email" type="email"/>
            <text-input v-model="form.password" :error="form.password.email" label="Password" type="password"/>

            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import TextInput from "@/Shared/TextInput.vue";

export default {
    components: {
        TextInput,
        Head,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: 'admin@marketron.app',
                password: 'secret',
                remember: false,
            }),
        }
    },
    methods: {
        login() {
            this.form.post('/admin/login')
        },
    },
}
</script>

