<template>
<default-layout>
    <div class="isolate bg-white">
        <main>
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
    methods: {}
}
</script>

<style scoped>
</style>
