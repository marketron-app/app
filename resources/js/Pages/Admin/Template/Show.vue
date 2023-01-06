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
