<template>
<default-layout>
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
                                    v-model="this.form.url"
                                    required
                                    autofocus
                                    autocomplete="url"
                                />
                                <button :disabled="!canSendRequest" class="ml-1 mt-1 inline-flex w-2/12 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700 disabled:opacity-25 disabled:cursor-not-allowed" type="submit">Generate</button>
                            </div>
                        </div>
                    </div>

                    <h2 class="mt-3 mb-0 text-xl">Select template</h2>
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
        </main>

    </div>
</default-layout>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

import DefaultLayout from "@/Layouts/Default.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "Index.vue",
    components: {InputLabel, TextInput, DefaultLayout},
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
          selectedTemplate: null
      }
    },
    props: {
        prefilledTemplate: Object,
        otherTemplates: Object,
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
                .post(this.route("images.store"))
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
