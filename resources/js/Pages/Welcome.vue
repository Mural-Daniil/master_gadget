<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Мастер гаджет"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-white  selection:bg-blue-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900  focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Войти</Link
                >

                <!-- <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500"
                    >Register</Link
                > -->
            </template>
        </div>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <Link href="/">
                    <ApplicationLogo class="w-72 h-auto" />
                </Link>
            </div>
        </div>
    </div>
</template>


