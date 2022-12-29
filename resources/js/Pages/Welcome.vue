<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import DefaultLayout from "@/Layouts/Default.vue";

defineProps({
});
</script>

<template>
    <DefaultLayout>
    <section>
        <div class="section header">
            <div class="d-flex container align-items-center flex-wrap py-5">
                <div class="col-12 col-md-6">
                    <h1>marketron</h1>
                    <p>
                        Create mockup previews on different devices, without the need to use
                        image editors. Just enter your website URL, select template and
                        generate your mockup!
                    </p>
                    <button class="secondary-button" href="#">
                        Create your first website preview
                    </button>
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <img
                        src="images/landing.svg"
                        alt="Landing image"
                        style="width: 100%"
                    />
                </div>
            </div>
            <img src="images/landing-waves.svg" alt="" class="w-100" />
        </div>

        <!-- Section 2 -->
        <section
            class="d-flex flex-wrap justify-content-center secondary-section container py-5"
        >
            <h2 class="text-center">
                Create professional looking website mockups, without the need to use
                image editors!
            </h2>
            <div class="d-flex flex-wrap col-12 col-md-10 mt-3">
                <input
                    type="text"
                    class="big-input col-12 col-md-10"
                    placeholder="https://www.marketron.app"
                    v-model="url"
                />
                <button
                    class="primary-button col-12 col-md-2 font-weight-bold mt-1 mt-md-0"
                    style="font-size: 1.3rem"
                    @click="() => {}"
                >
                    Go!
                </button>
            </div>
        </section>

        <!-- Section 3 -->
        <div class="d-flex flex-column">
            <img src="images/divider.svg" alt="" class="w-100" />
            <section
                class="d-flex flex-wrap justify-content-center py-5 purple-section w-100"
            >
                <div class="container">
                    <h2 class="text-center mb-5">Some of our examples</h2>
                    <div class="images d-flex flex-wrap justify-content-center">
                        <div
                            v-for="(image, key) in images"
                            :key="key"
                            class="image-wrapper col-6 col-md-3 my-2 px-2"
                            @click="() => {}"
                        >
                            <img class="image w-100 h-100" :src="image.src" />
                        </div>
                    </div>
                </div>
            </section>
            <img src="images/divider-rotated.svg" alt="" class="w-100" />
        </div>

        <!-- Section 4 -->
        <section class="container my-5 d-flex flex-wrap justify-content-center">
            <h2 class="text-center w-100">Subscribe to our newsletter</h2>
            <p class="text-center w-100">
                ... and become notified everytime we release new feature, or create a new
                template!
            </p>
            <div class="d-flex flex-wrap col-12 col-md-9 mt-3">
                <input
                    type="email"
                    class="big-input col-12 col-md-9 col-lg-10"
                    style="font-size: 1rem"
                    :placeholder="!isSubscribedToEmail ? 'Enter your email' : 'Thank you 🙏'"
                    v-model="email"
                    :disabled="isSubscribedToEmail"
                />
                <button
                    class="primary-button mt-1 mt-md-0 col-12 col-md-3 col-lg-2 font-weight-bold"
                    style="font-size: 1rem"
                    @click="subscribeToNewsletter"
                    :disabled="isSubscribedToEmail"
                >
                    Subscribe
                </button>
            </div>
        </section>
    </section>
    </DefaultLayout>
</template>

<script>
export default {
    name: 'IndexPage',
    data() {
        return {
            email: "",
            isSubscribedToEmail: false,
            url: '',
            images: [
                {
                    src: 'images/android-1-min.png',
                },
                {
                    src: 'images/iphone-1-min.png',
                },
                {
                    src: 'images/mac-2-min.png',
                },
                {
                    src: 'images/mac-monitor-1-min.png',
                },
            ],
        }
    },
    methods: {
        goToCreate() {
            console.log("Go to create")
        },

        async subscribeToNewsletter(){
            try {

                await this.$axios.post("newsletter", {
                    email: this.email
                });
                this.isSubscribedToEmail = true;
                this.email = "";
            } catch (error) {
                this.$bvToast.toast(error.response.data.message, {
                    title: "Error occurred 😔",
                    variant: "danger"
                });
            }


        }
    },
}
</script>

<style lang="scss">
.header {
    color: white;
    background-color: #752fe9;
}

.secondary-section {
    color: #752fe9;
}

.image-wrapper {
    border-radius: 10px;
    filter: drop-shadow(0px 4px 8px rgba(0, 0, 0, 0.25));
    cursor: pointer;
    overflow: hidden;
    max-height: 300px;
}

.image {
    width: 110%;
    object-fit: cover;
    border-radius: 10px;
    filter: grayscale(70%);
    transition: all 200ms ease-in-out;

    &:hover {
        filter: grayscale(0%);
    }
}
</style>

