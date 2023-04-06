<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head title="Роли" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Роли</h2>
        </template>
        <div class="py-8 px-40 mx-auto">
            <NavLink :href="route('add-role')">Добавить роль</NavLink>
        </div>

        <div v-for="role in roles" :key="role.id" class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h2 class="text-lg p-6 font-medium text-gray-900">{{ role.name }}</h2>
                    <div class="px-4">
                        <NavLink :href="route('edit-role', role.id)" class="m-2">Изменить</NavLink>
                        <NavLink :href="route('delete-role', role.id)" class="m-2">Удалить</NavLink>

                    </div>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
