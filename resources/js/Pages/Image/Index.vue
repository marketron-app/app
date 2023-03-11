<script setup>

import PrimaryButton from "@/Shared/PrimaryButton.vue";
</script>
<template>
<default-layout>
    <modal :show="showLoadingModal" :closeable="false">
        <div class="m-5 p-5 text-center">
            <h1 class="font-bold text-2xl">We are generating your image...</h1>
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
    </modal>
    <div class="isolate bg-white">
        <main>
            <form class="relative px-6 lg:px-8" @submit.prevent="submit">
                <div class="mx-auto max-w-5xl pt-10 pb-10 sm:pt-15 sm:pb-15">
                    <div class="flex">
                        <div class="w-full">
                            <InputLabel for="url" value="Website URL" />
                            <div class="flex">
                                <TextInput
                                    id="url"
                                    type="text"
                                    class="mt-1 block w-10/12"
                                    v-model="form.url"
                                    required
                                    autofocus
                                    autocomplete="url"
                                />
                                <primary-button :disabled="!canSendRequest" :is-loading="showLoadingModal" type="submit" class="ml-1 mt-1 inline-flex w-2/12 items-center font-medium" variation="primary">Generate</primary-button>
                            </div>
                            <div v-if="errors.url" class="text-red-800">{{ errors.url }}</div>
                            <div v-if="errors.generate" class="text-red-800">{{ errors.generate }}</div>

                        </div>
                    </div>

                    <div class="flex justify-between mt-3 mb-2">
                        <h2 class="mt-3 mb-0 text-xl">Select template</h2>
                        <TextInput
                            id="search"
                            type="text"
                            class="mt-1 block"
                            v-model="search"
                            @keyup="searchDebounce"
                            placeholder="Search (android, iphone, ...)"
                        />
                    </div>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        <div v-if="prefilledTemplate" class="group relative" @click="selectTemplate(prefilledTemplate.data)" :class="{selected: prefilledTemplate.data.id === selectedTemplate?.id}">
                            <div
                                class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-full">
                                <img :src="prefilledTemplate.data.thumbnailImage" alt="Template previews"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                            </div>
                        </div>
                        <div v-for="template in otherTemplates.data" :key="template.id" class="group relative" @click="selectTemplate(template)" :class="{selected: template.id === selectedTemplate?.id}">
                            <div
                                class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-full">
                                <img :src="template.thumbnailImage" alt="Template previews"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                            </div>
                        </div>
                    </div>


                </div>

            </form>

            <div class="flex justify-center w-full">
                <primary-button variation="primary" @click="loadMore" :is-loading="isLoadingMore" v-if="otherTemplates.meta.last_page > otherTemplates.meta.current_page">Load more</primary-button>

            </div>

        </main>

    </div>
</default-layout>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

import DefaultLayout from "@/Layouts/Default.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";

export default {
    name: "Index.vue",
    components: {Modal, InputLabel, TextInput, DefaultLayout},
    mounted() {
        if (this.prefilledTemplate){
            this.selectTemplate(this.prefilledTemplate.data)
        }
    },
    data(){
      return {
          form: useForm({
              url: ""
          }),
          selectedTemplate: null,
          showLoadingModal: false,
          isLoadingMore: false,
          search: "",
          timer: null
      }
    },
    props: {
        prefilledTemplate: Object,
        otherTemplates: Object,
        errors: Object
    },
    methods: {
        selectTemplate(template){
            this.selectedTemplate = template
        },
        submit(){
            this.form
                .transform((data) => ({
                    ...data,
                    template: this.selectedTemplate.identifier
                }))
                .post(this.route("images.store"), {
                    onStart: () => {this.showLoadingModal = true},
                    onFinish: this.handleOnFinish
                })
        },
        handleOnFinish(){
            this.showLoadingModal = false

            if(this.errors ){
                Object.values(this.errors).forEach((error) => {
                    this.$toast.error(error, {
                        position: "top-right"
                    });
                })
            }
        },
        async loadMore(){
            this.isLoadingMore = true
            try {
                const response = await window.axios.get(this.route("templates.more"), {
                    params: {
                        excluded: [...this.otherTemplates.data.map(el => el.identifier), ...(this.prefilledTemplate != null ? this.prefilledTemplate.data.identifier : [])]
                    }
                })

                this.otherTemplates.meta = response.data.meta
                this.otherTemplates.data.push(...response.data.data)

            }catch (e) {

            }finally {
                this.isLoadingMore = false
            }

        },
        searchDebounce(){
            clearTimeout(this.timer);

            this.timer = setTimeout(async () => {
                this.isLoadingMore = true
                try {
                    const response = await window.axios.get(this.route("templates.search"), {
                        params: {
                            search: this.search
                        }
                    })

                    this.otherTemplates.meta = response.data.meta
                    this.otherTemplates.data = response.data.data

                }catch (e) {

                }finally {
                    this.isLoadingMore = false
                }
            }, 300);
        }
    },
    computed: {
        canSendRequest(){
            return this.selectedTemplate && this.form.url
        }
    }
}
</script>

<style scoped>
.selected{
    box-shadow: 10px 10px 8px -8px rgba(0,0,0,0.75);
    border: 2px solid blueviolet;
}
</style>
