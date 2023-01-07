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

        <div class="py-12">
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
    }
}
</script>

<style scoped>

</style>
