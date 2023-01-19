<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {useForm} from "@inertiajs/inertia-vue3";
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <section class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
                <ApplicationLogo class="h-10 fill-current text-gray-500" />

            </a>
            <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                        Sign in to your account
                    </h1>
                    <div class="flex">
                        <a :href="route('google-redirect')" data-mdb-ripple="true" data-mdb-ripple-color="light" class="px-6 w-1/2 mr-1 py-2.5 mb-2 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out flex items-center" style="background-color: #1da1f2;">
                            <svg class="h-8 w-8 text-white mr-2"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M17.788 5.108A9 9 0 1021 12h-8" /></svg>
                            Google
                        </a>
                        <a :href="route('github-redirect')" data-mdb-ripple="true" data-mdb-ripple-color="light" class="px-6 w-1/2 ml-1 py-2.5 mb-2 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out flex items-center" style="background-color: #1da1f2;">
                            <svg class="h-8 w-8 text-white mr-2"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" /></svg>                            GitHub
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


</template>

<script>

export default {
    name: 'Login',
    data() {
        return {}
    },
    props: {
        templates: Object
    },
    methods: {},
}
</script>
