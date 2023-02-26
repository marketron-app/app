<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/24/solid";
import {format} from "date-fns";

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 flex justify-between">
                    <form class="w-1/4" method="get">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" :value="search" id="search" name="search"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Search">
                            <input hidden="true" :value="perPage" name="perPage" />
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                        </div>
                    </form>

                    <select v-model="perPageSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-1/6">
                        <option selected>Per page</option>
                        <option v-for="x in [10, 15, 20, 50, 75, 100]" :value="x" :key="x">{{ x }}</option>
                    </select>
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
                                Email
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Auth Provider
                            </th>
                            <th scope="col" class="py-3 px-6">
                                No. generated images
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Registered At
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b " v-for="user in users.data" :key="user.id">
                            <th scope="row" class="py-4 px-6">
                                {{user.id}}
                            </th>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{user.name}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{user.email}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{user.authProvider}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{user.numberOfImages}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{format(new Date(user.createdAt), 'MM/dd/yyyy (HH:mm)')}}
                            </td>

                        </tr>
                        </tbody>
                    </table>


                </div>

                <div class="pt-2">
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a :href="users.links.prev" class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                        </a>
                        <a v-if="users.links.prev" :href="users.links.prev" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{users.meta.current_page - 1}}</a>
                        <a aria-current="page" class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">{{users.meta.current_page}}</a>
                        <a v-if="users.links.next" :href="users.links.next" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{users.meta.current_page + 1}}</a>
                        <span v-if="users.meta.current_page + 2 < users.meta.last_page" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
                        <a  v-if="users.meta.current_page + 1 < users.meta.last_page" :href="users.links.last" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{users.meta.last_page}}</a>
                        <a :href="users.links.next" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                        </a>
                    </nav>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: "Index.vue",
    data(){
        return {
            perPageSelect: 15
        }
    },
    props: {
        users: Object,
        perPage: {
            type: Number,
            default: 15
        },
        search: String
    },
    mounted() {
        this.perPageSelect = this.perPage
    },
    watch: {
        perPageSelect(newVal, oldVal){
            if(newVal !== this.perPage)
                this.$inertia.get(route('admin.users.index', {'perPage': newVal, 'search': this.search}))
        }
    }
}
</script>

<style scoped>

</style>
