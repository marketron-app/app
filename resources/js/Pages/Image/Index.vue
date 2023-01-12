<template>
<default-layout>
    <div class="isolate bg-white">
        <main>
            <div class="relative px-6 lg:px-8">
                <div class="mx-auto max-w-3xl pt-10 pb-10 sm:pt-15 sm:pb-15">
                    <div>
                        <h1>Image</h1>
                    </div>
                </div>
            </div>
        </main>

    </div>
</default-layout>
</template>

<script>
import DefaultLayout from "@/Layouts/Default.vue";

export default {
    name: "Index.vue",
    components: {DefaultLayout},
    props: {
        selectedTemplate: Object,
        otherTemplates: Object
    }
}
</script>

<style scoped>

</style>
