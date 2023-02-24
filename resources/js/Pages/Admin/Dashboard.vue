<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Marketron Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex ">
                <div class=" w-1/2 px-2">
                <a :href="route('admin.users.index')" class="block p-6 bg-white border w-full border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Users</h5>
                    <p class="font-normal text-gray-700">{{totalUsers}}
                        <span class="text-xs" :class="{'text-green-600': (newUsers > 0)}">(+{{newUsers}})</span>
                    </p>
                </a>
                </div>
                <div class="w-1/2 px-2">
                <a :href="route('admin.images.index')" class="block p-6 bg-white w-full border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Images</h5>
                    <p class="font-normal text-gray-700">{{totalImages}}
                        <span class="text-xs" :class="{'text-green-600': (newImages > 0)}">(+{{newImages}})</span>
                    </p>
                </a>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: "Dashboard",
    props: {
        "totalUsers": {},
        "newUsers": {},
        "totalImages": {},
        "newImages": {}
    }
}
</script>
