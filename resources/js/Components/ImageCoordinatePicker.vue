<template>
    <section>
        <div class="flex w-full">
            <div class="w-3/4 p-2">
                <div v-show="!file" class="flex items-center justify-center w-full">
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
                </div>
                <div v-show="file">
                    <input @change="setFile" placeholder="Select new picture..." class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer" id="file_input" type="file" accept="image/*">
                    <canvas id="image-canvas" class="max-w-full"></canvas>
                </div>
            </div>
            <div class="w-1/4 p-2">
                <p>First, select the area which will be replaced with screenshot. Order of the points is not important.</p>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "ImageCoordinatePicker",
    data(){
        return {
            file: null
        }
    },
    methods: {
        setFile(event){
            this.file = event.target.files[0];

                let reader = new FileReader();
                // Read in the image file as a data URL.
                reader.readAsDataURL(this.file);
                reader.onloadend = function (e) {
                    let image = new Image();
                    image.src = e.target.result;
                    image.onload = function(ev) {
                        let canvas = document.getElementById('image-canvas');
                        canvas.width = image.width;
                        canvas.height = image.height;
                        let ctx = canvas.getContext('2d');
                        ctx.drawImage(image,0,0);
                    }
                }

        }
    }
}
</script>

<style scoped>

</style>
