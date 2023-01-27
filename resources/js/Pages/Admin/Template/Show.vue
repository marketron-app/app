<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import Modal from "@/Components/Modal.vue";
import {format} from "date-fns";
</script>

<template>
    <div id="loading-screen" v-if="isRequesting" class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50 flex justify-center items-center">
        <div class="m-5 p-5 text-center">
            <h1 class="font-bold text-2xl">Loading...</h1>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-10 w-10 flex-1 animate-spin stroke-current stroke-[3] mx-auto mt-5"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                    class="stroke-current opacity-25"
                />
                <path d="M12 2C6.47715 2 2 6.47715 2 12C2 14.7255 3.09032 17.1962 4.85857 19" />
            </svg>
        </div>
    </div>

    <Head title="Show template" />
    <modal :show="showReplaceTemplateModal" @close="() => { showReplaceTemplateModal = false}">
        <div class="m-5 p-5 text-center">
            <h1 class="font-bold text-2xl">Replace current template image with new one</h1>
            <p class="mb-3">Image must have the same resolution as the current one <strong>({{template.rawData.width}}x{{template.rawData.height}})</strong>.</p>

            <label for="dropzone-file"
                   class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span>
                        or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG or JPG</p>
                </div>
                <input @change="setFile" id="dropzone-file" type="file" class="hidden" accept="image/*"/>

            </label>
            <p class="text-sm" v-if="replaceImageForm.templateImage">{{replaceImageForm.templateImage.name}}</p>
            <button @click="replaceTemplateImage" :disabled="!replaceImageForm.templateImage || replaceImageForm.processing" type="button" class=" disabled:opacity-25 disabled:cursor-not-allowed w-full mt-3 p-2 font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <span v-if="replaceImageForm.processing">Saving...</span>
                <span v-else>Save</span>
            </button>

        </div>
    </modal>

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
                <span>This template was published on <strong>{{format(new Date(template.publishedAt), 'MM/dd/yyyy (HH:mm)')}}</strong>. Users can see it.</span>
                <button @click="unpublish" type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Unpublish</button>

            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <p class="text-lg">Identifier: <strong>{{template.identifier}}</strong></p>
                <p class="text-lg">Screenshot width: <strong>{{template.screenshotWidth}}</strong></p>
                <p class="text-lg">Screenshot height: <strong>{{template.screenshotHeight}}</strong></p>

                <hr class="my-3">
                <AccordionList>
                    <AccordionItem>
                        <template #summary>Media</template>
                        <template #icon>🖼️</template>
                        <div>
                            <div class="flex" v-if="template.thumbnailImage && this.templateUrl">
                                <div class="w-1/2 p-3">
                                    <p class="text-lg font-bold">Thumbnail image:</p>
                                    <img class="h-auto rounded-lg shadow-md dark:shadow-gray-800 w-100" :src="template.thumbnailImage" alt="image description">
                                    <button @click="rerenderThumbnail" type="button" class="w-full mt-3 p-2 font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Rerender thumbnail</button>

                                </div>
                                <div class="w-1/2 p-3">
                                    <p class="text-lg font-bold">Template image:</p>
                                    <img class="h-auto rounded-lg shadow-md dark:shadow-gray-800 w-100 background-rectangles" :src="template.templateUrl" alt="image description">
                                    <button @click="showReplaceTemplateModal = true" type="button" class="w-full mt-3 p-2 font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Replace</button>
                                </div>
                            </div>
                            <div v-else>
                                <p>Template is currently processing. Check events below for more information.</p>
                            </div>
                        </div>
                    </AccordionItem>
                </AccordionList>

                <hr class="my-3">

                <AccordionList>
                    <AccordionItem>
                        <template #summary>Coordinates</template>
                        <template #icon>️🧭</template>
                        <div>

                            <p class="text-lg font-bold">Screenshot coordinates</p>
                            <pre class="" v-html="JSON.stringify(template.screenshotCoordinates, null, 2)"></pre>
                        </div>
                    </AccordionItem>
                </AccordionList>


            </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";
import VueSimpleAlert from "vue3-simple-alert";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Show",
    data(){
      return {
          showReplaceTemplateModal: false,
          replaceImageForm: new useForm({
              templateImage: null
          }),
          isRequesting: false
      }
    },
    props: {
        template: Object
    },
    methods: {
        publish(){
            this.$inertia.post(this.route("admin.templates.publish", this.template.id))
        },
        unpublish(){
            this.$inertia.post(this.route("admin.templates.unpublish", this.template.id))
        },
        replaceTemplateImage(){
            this.replaceImageForm.post(this.route("admin.templates.update-template-image", this.template.id), {
                onFinish: () => {this.showReplaceTemplateModal = false}
            })
        },
        setFile(event) {
            this.replaceImageForm.templateImage = event.target.files[0];
        },
        rerenderThumbnail(){
            VueSimpleAlert.confirm(
                "Are you sure you want to replace current thumbnail image?" ,
                "Thumbnail rerender",
                "warning"
            ).then(async () => {
                Inertia.post(this.route("admin.templates.rerender", this.template.id), {}, {
                    onStart: () => {this.isRequesting = true},
                    onFinish: () => {this.isRequesting = false}
                })
            }).catch((e) => {
                this.$toast.error(e);
            });
        }
    }
}
</script>

<style scoped>
.background-rectangles{
    background-color: #e5e5f7;
    opacity: 0.8;
    background-image:  repeating-linear-gradient(45deg, #7c7c7c 25%, transparent 25%, transparent 75%, #7c7c7c 75%, #7c7c7c), repeating-linear-gradient(45deg, #7c7c7c 25%, #e5e5f7 25%, #e5e5f7 75%, #7c7c7c 75%, #7c7c7c);
    background-position: 0 0, 10px 10px;
    background-size: 20px 20px;
}
</style>
