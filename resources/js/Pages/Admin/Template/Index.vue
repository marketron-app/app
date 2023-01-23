<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ChevronLeftIcon, ChevronRightIcon, PlusIcon, CheckBadgeIcon} from "@heroicons/vue/24/solid";
import Popper from "vue3-popper";
import PrimaryButton from "@/Shared/PrimaryButton.vue";

</script>

<script>
import VueSimpleAlert from "vue3-simple-alert";
import {useForm} from "@inertiajs/inertia-vue3";

const form = useForm();

export default {
    props: {
        templates: Object
    },
    methods: {
        destroy(id){
            VueSimpleAlert.confirm(
                "Are you sure you want to delete the template with ID " + id + "?" ,
                "Template delete",
                "warning"
            ).then(async () => {
                this.$inertia.delete(this.route("admin.templates.destroy", id))
            }).catch((e) => {
                this.$toast.error(e);
            });
        },
        show(id){
            this.$inertia.get(this.route("admin.templates.show", id))
        },
        publish(id){
            this.$inertia.post(this.route("admin.templates.publish", id))
        },
        unpublish(id){
            this.$inertia.post(this.route("admin.templates.unpublish", id))
        }
    }
}
</script>

<template>
    <Head title="Templates" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Templates</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                    <Link :href="route('admin.templates.create')" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <div class="inline-flex items-center">
                        New template
                        <PlusIcon class="ml-1 h-4 w-4" />
                        </div>
                    </Link>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs  uppercase">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Identifier
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Tags
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b " v-for="template in templates.data" :key="template.id">
                            <th scope="row" class="py-4 px-6">
                                <div class="flex align-items-center justify-content-center">
                                    <Popper content="This template is published." hover placement="top" v-if="template.publishedAt">
                                        <CheckBadgeIcon class="h-5 w-5 mr-1 text-blue-500"/>
                                    </Popper>

                                {{template.id}}
                                </div>
                            </th>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{template.title}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{template.identifier}}
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800" v-for="tag in template.tags">
                                    {{tag}}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <primary-button @click="show(template.id)" variation="primary" class="mx-1">Show</primary-button>
                                <a :href="route('images.index') + '?identifier=' + template.identifier" target="_blank" class="py-2 px-3 mx-1 text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Open</a>
                                <primary-button v-if="!template.publishedAt" @click="publish(template.id)" variation="info" class="mx-1">Publish</primary-button>
                                <primary-button v-if="template.publishedAt" @click="unpublish(template.id)" variation="info" class="mx-1">Unpublish</primary-button>
                                <primary-button :disabled="!!template.publishedAt" @click="destroy(template.id)" variation="danger" class="mx-1">Delete</primary-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>

                <div class="pt-2">
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a :href="templates.links.prev" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                        </a>
                        <a v-if="templates.links.prev" :href="templates.links.prev" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{templates.meta.current_page - 1}}</a>
                        <a aria-current="page" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">{{templates.meta.current_page}}</a>
                        <a v-if="templates.links.next" :href="templates.links.next" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{templates.meta.current_page + 1}}</a>
                        <span v-if="templates.meta.current_page + 2 < templates.meta.last_page" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
                        <a  v-if="templates.meta.current_page + 1 < templates.meta.last_page" :href="templates.links.last" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{templates.meta.last_page}}</a>
                        <a :href="templates.links.next" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
