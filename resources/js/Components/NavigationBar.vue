<template>
    <nav class="w-100 d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">
            <NuxtLink to="/" class="logo">marketron</NuxtLink>
            <div v-if="true">
                <NuxtLink to="/login" tag="button" class="primary-button"
                >Join Us</NuxtLink
                >
            </div>
            <div v-else>
                <b-dropdown variant="outline-info" class="m-md-2">
                    <template #button-content>
                        <i class="fas fa-user"></i>
                        {{ $auth.user.name }}
                    </template>
                    <b-dropdown-item @click="$router.push('/my-mocks')"
                    >My mockups</b-dropdown-item
                    >
                    <b-dropdown-divider></b-dropdown-divider>
                    <b-dropdown-item @click="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </b-dropdown-item>
                </b-dropdown>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'NavigationBar',
    methods: {
    },
}
</script>

<style scoped lang="scss">
nav {
    height: 60px;
    background-color: white;
    box-shadow: 0 4px 9px rgba(0, 0, 0, 0.25);
    z-index: 100;
    position: relative;
}

.logo {
    font-size: 1.6rem;
    font-weight: bolder;
    cursor: pointer;
    text-decoration: none;
    color: black;
}

.secondary-btn {
    background-color: white;
    border-radius: 15px;
    padding: 10px 20px;
    border: none;
    color: #752fe9;
}

.user-button {
    outline: none;
    border: none;
    border-radius: 5px;
}
</style>
