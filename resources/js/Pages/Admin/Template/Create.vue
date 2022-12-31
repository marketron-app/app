<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {PlusIcon} from "@heroicons/vue/24/solid"
import InputError from "@/Components/InputError.vue";
import ImageCoordinatePicker from "@/Components/ImageCoordinatePicker.vue";

</script>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    data(){
        return{
            currentKeyword: "",
            keywords: [],
            form: useForm({
                title: '',
                identifier: '',
                description: '',
                keywords: [],
            })
        }
    },
    methods: {
        addKeyword()  {
            this.keywords.push(this.currentKeyword)
            this.currentKeyword = ""
        },
        removeKeyword(index)  {
            this.keywords.splice(index, 1)
        },
        submit(){
            this.form.keywords = this.keywords
            this.form.post(route('templates.store'), {
                onFinish: () => this.this.form.reset(),
            });
        }
    }
}
</script>

<template>
    <Head title="Create template" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Templates</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <div class="text-gray-900">
                        <h1 class="text-2xl">Create new template</h1>
                    </div>

                    <form @submit.prevent="submit" class="mt-3">
                        <div class="">
                            <InputLabel for="title" value="Title" />
                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="this.form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />
                            <InputError class="mt-2" :message="this.form.errors.title" />

                            <InputLabel for="description" value="Description" class="my-2"/>
                            <textarea
                                id="description"
                                type="textarea"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                v-model="this.form.description"
                                required
                                autofocus
                                autocomplete="title"
                            />
                            <InputError class="mt-2" :message="this.form.errors.description" />


                            <InputLabel for="keywords" value="Keywords" class="mt-2"/>

                            <div class="inline-flex w-full">
                                <TextInput
                                    id="keywords"
                                    type="text"
                                    class="mt-1 block w-11/12"
                                    v-model="currentKeyword"
                                    required
                                    @keyup.enter.prevent="addKeyword"
                                />
                                <PrimaryButton class="ml-4 mt-1 w-1/12 justify-center" :class="{ 'opacity-25': this.form.processing }" type="button" @click.native="addKeyword()">
                                    <PlusIcon class="w-5 h-5"/>
                                </PrimaryButton>
                            </div>
                            <div class="inline-flex mt-1">
                                <span v-for="(keyword, index) in keywords" :key="index" class="cursor-pointer bg-blue-100 text-blue-800 text-m font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800" @click="removeKeyword(index)">{{ keyword }}</span>

                            </div>
                            <InputError class="mt-2" :message="this.form.errors.keywords" />

                            <InputLabel for="image" value="Image" class="mt-5"/>
                            <ImageCoordinatePicker class="w-full"/>

                        </div>


                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<style scoped>

</style>
