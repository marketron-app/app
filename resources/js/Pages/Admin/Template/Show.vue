<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Show template" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Template: <strong>{{ template.title }} ({{template.id}})</strong></h2>
        </template>


        <div class="py-8">

            <div v-if="!template.publishedAt" class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg max-w-7xl mx-auto flex justify-between items-center" role="alert">
                Template is not published yet, so users won't see it.
                <button @click="publish" type="button" class="py-2 px-3 mr-1 text-xs font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Publish</button>

            </div>
            <div v-else class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg max-w-7xl mx-auto flex justify-between items-center" role="alert">
                <span>This template was published on {{template.publishedAt}}. Users can see it.</span>
                <button @click="unpublish" type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Unpublish</button>

            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <p class="text-lg">Identifier: <strong>{{template.identifier}}</strong></p>

                <p class="text-lg font-bold">Thumbnail image:</p>
                <img class="h-auto max-w-xl rounded-lg shadow-md dark:shadow-gray-800" :src="template.thumbnailImage" alt="image description">


            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: "Show",
    props: {
        template: Object
    },
    methods: {
        publish(){
            this.$inertia.post(this.route("templates.publish", this.template.id))
        },
        unpublish(){
            this.$inertia.post(this.route("templates.unpublish", this.template.id))
        }
    }
}
</script>

<style scoped>

</style>
