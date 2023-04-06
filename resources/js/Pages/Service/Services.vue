<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    services: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head title="Услуги" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Услуги</h2>
        </template>
        <div class="py-8 px-40 mx-auto">
            <NavLink :href="route('add-service')">Добавить услугу</NavLink>
        </div>

        <div v-for="service in services" :key="service.id" class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-lg p-6 font-medium text-gray-900">{{ service.title }}</h2>
                    <p class="px-6  text-gray-900">{{ service.category }}</p>

                    <p class="mt-1 px-6 text-sm text-gray-600">
                        {{ service.about }}
                    </p>
                    <div class="p-4">
                        <NavLink :href="route('edit-service', service.id)" class="m-2">Изменить</NavLink>
                        <NavLink :href="route('delete-service', service.id)" class="m-2">Удалить</NavLink>

                    </div>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
