<template>
<default-layout>
    <div class="isolate bg-white">
        <main>
            <div class="relative px-6 lg:px-8">
                <div class="mx-auto max-w-5xl pt-10 pb-10 sm:pt-15 sm:pb-15">
                    <div class="w-full">
                        <InputLabel for="url" value="Website URL" />
                        <TextInput
                            id="url"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="this.form.url"
                            required
                            autofocus
                            autocomplete="url"
                        />
                    </div>

                    <h2 class="mt-3 mb-0 text-xl">Select template</h2>
                    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        <div v-if="selectedTemplate" class="group relative">
                            <div
                                class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                                <img :src="selectedTemplate.data.thumbnailImage" alt="Template previews"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <button>
                                            <span aria-hidden="true" class="absolute inset-0"/>
                                            {{ selectedTemplate.data.title }}
                                        </button>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div v-for="template in otherTemplates.data" :key="template.id" class="group relative">
                            <div
                                class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                                <img :src="template.thumbnailImage" alt="Template previews"
                                     class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <button>
                                            <span aria-hidden="true" class="absolute inset-0"/>
                                            {{ template.title }}
                                        </button>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
export default {
    name: "Index.vue",
    components: {InputLabel, TextInput, DefaultLayout},
    data(){
      return {
          form: useForm({
              url: ""
          })
      }
    },
    props: {
        selectedTemplate: Object,
        otherTemplates: Object
    }
}
</script>

<style scoped>

</style>
