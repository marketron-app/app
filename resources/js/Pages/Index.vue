<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
</script>

<template>
    <default-layout>
        <div class="isolate bg-white">
            <main>
                <div class="relative px-6 lg:px-8">
                    <div class="mx-auto max-w-3xl pt-20 pb-32 sm:pt-48 sm:pb-40">
                        <div>
                            <div>
                                <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl">Marketron</h1>
                                <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">Create mockup previews on
                                    different devices, without the need to use image editors. Just enter your website
                                    URL, select template and generate your mockup!</p>
                                <div class="mt-8 flex gap-x-4 sm:justify-center">
                                    <a href="/image"
                                       class="inline-block rounded-lg bg-indigo-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">
                                        Get started
                                        <span class="text-indigo-200" aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Some of our templates</h2>

                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="template in templates.data" :key="template.id" class="group relative">
                        <div
                            class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
                            <img :src="template.thumbnailImage" alt="Template previews"
                                 class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <a :href="'/image?identifier=' + template.identifier">
                                        <span aria-hidden="true" class="absolute inset-0"/>
                                        {{ template.title }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </default-layout>
    <div class="bg-gray-50">
        <div class="mx-auto max-w-7xl py-12 px-6 lg:flex lg:items-center lg:justify-between lg:py-16 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Ready to generate your first image?</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="/image" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700">Get started</a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'IndexPage',
    data() {
        return {}
    },
    props: {
        templates: Object
    },
    methods: {},
}
</script>

<style lang="scss">
</style>

