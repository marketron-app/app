<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import {ChevronLeftIcon, ChevronRightIcon, ArrowRightIcon} from "@heroicons/vue/24/solid";
import {format} from "date-fns";

</script>
<template>
<default-layout>
    <div class="isolate bg-white">
        <main>
            <div class="relative px-6 lg:px-8">
                <div class="mx-auto max-w-5xl pt-10 pb-10 sm:pt-15 sm:pb-15">
                    <h1 class="text-xl font-bold">My images</h1>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs  uppercase">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        URL
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Template
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Date
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white border-b " v-for="image in images.data" :key="image.id">
                                    <th scope="row" class="py-4 px-6">
                                        <a :href="image.url" target="_blank">
                                            {{image?.url}}
                                        </a>
                                    </th>
                                    <th scope="row" class="py-4 px-6">
                                        {{image.template?.identifier}}
                                    </th>
                                    <td class="py-4 px-6 font-medium whitespace-nowrap">
                                        {{format(new Date(image.createdAt), 'MM/dd/yyyy (HH:mm)')}}
                                    </td>
                                    <td>
                                        <a :href="'/image/' + image?.id" target="_blank" class=" cursor-pointer">
                                            <ArrowRightIcon class="h-5 w-5"/>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


                        </div>

                        <div class="pt-2">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <a :href="images.links.prev" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                                    <span class="sr-only">Previous</span>
                                    <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                                </a>
                                <a v-if="images.links.prev" :href="images.links.prev" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{images.meta.current_page - 1}}</a>
                                <a aria-current="page" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">{{images.meta.current_page}}</a>
                                <a v-if="images.links.next" :href="images.links.next" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{images.meta.current_page + 1}}</a>
                                <span v-if="images.meta.current_page + 2 < images.meta.last_page" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
                                <a  v-if="images.meta.current_page + 1 < images.meta.last_page" :href="images.links.last" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{images.meta.last_page}}</a>
                                <a :href="images.links.next" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                                    <span class="sr-only">Next</span>
                                    <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                                </a>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </main>

    </div>

</default-layout>
</template>

<script>

export default {
    name: "Index.vue",
    components: {},
    props: {
        images: Object
    }
}
</script>

<style scoped>

</style>
