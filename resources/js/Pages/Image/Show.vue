<script setup>
import { Head } from '@inertiajs/inertia-vue3'
</script>

<template>
    <Head>
        <meta name="description" content="Generated image on Marketron">
        <title>Generated image</title>
        <meta property="og:title" :content="'Mockup for ' + image.data.url" />
        <meta property="og:description" content="See how your website would look on real world devices" />
        <meta property="og:image" :content="image.data.path" />
    </Head>
<default-layout>
    <div class="isolate bg-white">
        <main>
            <div class="sharing-buttons flex flex-wrap justify-center align-center">
                <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition py-3 px-5 rounded-lg text-white border-blue-600 bg-blue-600 hover:bg-blue-700 hover:border-blue-700"  rel="noopener" href="#" @click.prevent="copyLink" aria-label="Share">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                    </svg>

                    <span class="ml-2">Copy link</span>
                </a>
                <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition py-3 px-5 rounded-lg text-white border-blue-600 bg-blue-600 hover:bg-blue-700 hover:border-blue-700" target="_blank" rel="noopener" :href="'https://facebook.com/sharer/sharer.php?u=https://www.marketron.app/image/' + image.data.id" aria-label="Share on Facebook">
                    <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                        <title>Facebook</title>
                        <path d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                        </path>
                    </svg>
                    <span class="ml-2">Facebook</span>
                </a>
                <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition py-3 px-5 rounded-lg text-white border-blue-600 bg-blue-600 hover:bg-blue-700 hover:border-blue-700" target="_blank" rel="noopener" :href="'https://twitter.com/intent/tweet?url=https://www.marketron.app/image/'+image.data.id+'&text=Check my generated image on Marketron'" aria-label="Share on Twitter">
                    <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                        <title>Twitter</title>
                        <path d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                        </path>
                    </svg>
                    <span class="ml-2">Twitter</span>
                </a>
            </div>
            <div class="flex content-center items-center justify-center my-3">
                <img :src="image.data.path" :alt="image.data.url + ' image'" class="mw-100">
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
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "Show.vue",
    components: {InputLabel, TextInput, DefaultLayout},
    mounted() {
    },
    data(){
      return {
      }
    },
    props: {
        image: Object,
    },
    methods: {
        copyLink(){
            navigator.clipboard.writeText("https://www.marketron.app/image/" + this.image.data.id);
            this.$toast.info("URL copied to clipboard", {
                position: "top-right"
            });
        }
    }
}
</script>

<style scoped>
</style>
