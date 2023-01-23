<template>
    <button :type="type" :disabled="disabled" :class="'py-2 px-3 text-center text-white disabled:opacity-25 disabled:cursor-not-allowed rounded-md border border-transparent ' + variationClasses">
        <slot v-if="!isLoading"></slot>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 flex-1 animate-spin stroke-current stroke-[3] mx-auto"
            fill="none"
            viewBox="0 0 24 24"
            v-else
        >
            <path
                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                class="stroke-current opacity-25"
            />
            <path d="M12 2C6.47715 2 2 6.47715 2 12C2 14.7255 3.09032 17.1962 4.85857 19" />
        </svg>
    </button>

</template>

<script>
export default {
    name: "PrimaryButton",
    props: {
        type: {
            type: String,
            default: "button"
        },
        variation: {
            type: String,
            validator(value) {
                return ['primary', 'secondary', 'info', 'danger'].includes(value)
            }
        },
        disabled: {
            type: Boolean,
            default: false
        },
        isLoading: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        variationClasses(){
            switch (this.variation) {
                case 'primary': return 'bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'
                case 'secondary': return 'bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800'
                case 'danger': return 'bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800'
                case 'info': return 'bg-yellow-700 rounded-lg hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800'
            }
        }
    }
}
</script>

<style scoped>

</style>
