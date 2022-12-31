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
                    <button @click="clearPoints" type="button" class="py-2 px-3 mb-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Clear points</button>

                    <div style="position: relative; height: fit-content">
                        <canvas id="image-canvas" style="position: relative; left: 0; top: 0; z-index: 0;"></canvas>
                        <canvas id="points-canvas" style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
                    </div>
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
            file: null,
            points: [],
            width: 0,
            height: 0,
            scale: 0,
            canvas: null,
            canvasCtx: null,
            pointsCanvas: null,
            pointsCanvasCtx: null
        }
    },
    mounted() {
        this.canvas = document.getElementById('image-canvas');
        this.pointsCanvas = document.getElementById('points-canvas');
        this.pointsCanvas.addEventListener("click", this.onCanvasClick)

        this.canvasCtx = this.canvas.getContext("2d")
        this.pointsCanvasCtx = this.pointsCanvas.getContext("2d")
    },
    watch: {
        points: {
            deep: true,
            handler(old, points)
                {
                    this.drawPoints()
                }
        }
    },
    methods: {
        setFile(event){
            this.file = event.target.files[0];
            this.drawImage()
        },
        drawImage(){
            let reader = new FileReader();
            // Read in the image file as a data URL.
            reader.readAsDataURL(this.file);
            reader.onloadend =  (e) => {
                let image = new Image();
                image.src = e.target.result;
                image.onload = (ev) => {
                    this.width = this.canvas.parentElement.clientWidth
                    this.scale = (this.width / image.width);
                    this.height = this.scale * image.height
                    this.canvas.width = this.width;
                    this.canvas.height = this.height;
                    this.pointsCanvas.width = this.width;
                    this.pointsCanvas.height = this.height;
                    this.canvasCtx.drawImage(image,0,0, this.width, this.height);
                }
            }
        },
        onCanvasClick(e){
            let rect = this.pointsCanvas.getBoundingClientRect();
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;
            this.points.push({x, y})
        },
        redraw(){
            this.pointsCanvasCtx.clearRect(0, 0, this.pointsCanvasCtx.canvas.width, this.pointsCanvasCtx.canvas.height)

        },
        drawPoints(){
            this.redraw()
            this.pointsCanvasCtx.fillStyle = "rgba(255,0,0,0.57)"
            this.pointsCanvasCtx.beginPath()
            this.points.forEach((value, i) => {
                this.pointsCanvasCtx.fillRect(value.x - 2.5, value.y - 2.5, 5, 5)
                this.pointsCanvasCtx.lineTo(value.x, value.y)
            })
            this.pointsCanvasCtx.closePath()
            this.pointsCanvasCtx.fill()
        },
        clearPoints(){
            this.points = []
            this.redraw()
        }
    }
}
</script>

<style scoped>

</style>
