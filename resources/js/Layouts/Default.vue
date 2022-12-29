<template>
    <div>
        <NavigationBar />
        <slot style="min-height: calc(100vh - 60px - 143px)" />
        <FooterBar />
    </div>
</template>

<script>
import NavigationBar from "@/Components/NavigationBar.vue";
import FooterBar from "@/Components/FooterBar.vue";

export default {
    name: 'DefaultLayout',
    components: {FooterBar, NavigationBar},
}
</script>

<style lang="scss">
@import '../../css/variables';
body {
    background-color: #f4f4f4;
}

.primary-button {
    background: #752fe9;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 10px 20px;
    color: white;
    border: none;

    &:disabled,
    &[disabled]{
        background: #c09bfa;
        cursor: not-allowed;

    }
}

.secondary-button {
    background: white;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 10px 20px;
    color: #752fe9;
    border: none;
}

.big-input {
    background: #ffffff;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
    padding: 10px 20px;
    font-size: 1rem;
    border: 0px;
}

.purple-section {
    color: white;
    background-color: #752fe9;
}
</style>
