<template>
    <div class="d-flex flex-column">
        <img src="images/divider.svg" alt="" class="w-100" />

        <footer>
            <div class="container d-flex flex-wrap justify-content-center pt-0 pb-3">
                <div class="logo">marketron</div>
                <div class="w-100 d-flex flex-wrap justify-content-center">
                    <a class="mx-2" href="/">home</a>
                    <a class="mx-2" href="/about">about</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'FooterBar',
}
</script>

<style scoped lang="scss">
footer {
    color: white;
    background-color: #752fe9;
}

.logo {
    font-weight: bolder;
    font-size: 2rem;
}

a {
    color: white;
}
</style>
