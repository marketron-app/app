<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {ChevronLeftIcon, ChevronRightIcon} from "@heroicons/vue/24/solid";
import {format} from "date-fns";
import PrimaryButton from "@/Shared/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";

</script>

<template>
    <Head title="images"/>
    <Modal :show="showMetricsModal" @close="() => { showMetricsModal = false}">
        <div class="m-5 p-5">
            <div v-if="selectedImage">
                <h1 class="text-xl text-center font-bold">Image generation metrics</h1>
                <p><strong>Crawler:</strong> {{selectedImage.metrics.crawler}}ms</p>
                <p><strong>Transformer:</strong> {{selectedImage.metrics.transformer}}ms</p>
                <p><strong>Uploader:</strong> {{selectedImage.metrics.uploader}}ms</p>
            </div>

        </div>
    </Modal>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">images</h2>
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
                                URL
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Template
                            </th>
                            <th scope="col" class="py-3 px-6">
                                User
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Date
                            </th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b " v-for="image in images.data" :key="image.id">
                            <th scope="row" class="py-4 px-6">
                                {{ image.id }}
                            </th>
                            <td class="py-4 px-6 font-medium whitespace-normal">
                                <a :href="image.url" target="_blank">{{ image.url }}</a>
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-normal">
                                {{image.template?.identifier}}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                <span v-if="image.user">
                                {{ image.user.email }}</span>
                                <span v-else>-</span>
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                {{ format(new Date(image.createdAt), 'MM/dd/yyyy (HH:mm)') }}
                            </td>
                            <td class="py-4 px-6 font-medium whitespace-nowrap">
                                <a :href="route('images.show', image.id)" target="_blank">
                                    <primary-button variation="primary">
                                        Show
                                    </primary-button>
                                </a>
                                <primary-button variation="info" :disabled="!image.metrics" @click="showMetrics(image)" class="ml-1">
                                    Metrics
                                </primary-button>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>

                <div class="pt-2">
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <a :href="images.links.prev"
                           class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Previous</span>
                            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true"/>
                        </a>
                        <a v-if="images.links.prev" :href="images.links.prev"
                           class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{ images.meta.current_page - 1 }}</a>
                        <a aria-current="page"
                           class="relative z-10 inline-flex items-center border border-indigo-500 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-600 focus:z-20">{{ images.meta.current_page }}</a>
                        <a v-if="images.links.next" :href="images.links.next"
                           class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{ images.meta.current_page + 1 }}</a>
                        <span v-if="images.meta.current_page + 2 < images.meta.last_page"
                              class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700">...</span>
                        <a v-if="images.meta.current_page + 1 < images.meta.last_page" :href="images.links.last"
                           class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">{{ images.meta.last_page }}</a>
                        <a :href="images.links.next"
                           class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
                            <span class="sr-only">Next</span>
                            <ChevronRightIcon class="h-5 w-5" aria-hidden="true"/>
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
    data() {
        return {
            showMetricsModal: false,
            selectedImage: null,
            perPageSelect: 15
        }
    },
    props: {
        images: Object,
        perPage: {
            type: Number,
            default: 15
        },
        search: String
    },
    methods: {
        showMetrics(image) {
            this.selectedImage = image
            this.showMetricsModal = true
        }
    },
    mounted() {
        this.perPageSelect = this.perPage
    },
    watch: {
        perPageSelect(newVal, oldVal){
            if(newVal !== this.perPage)
                this.$inertia.get(route('admin.images.index', {'perPage': newVal, 'search': this.search}))
        }
    }
}
</script>

<style scoped>

</style>
