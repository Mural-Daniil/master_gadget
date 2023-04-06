<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    users: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Пользователи</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">                        
                    <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="pb-4 pt-6 px-6">ФИО</th>
                            <th class="pb-4 pt-6 px-6" colspan="2">Email</th>
                            <th class="pb-4 pt-6 px-6">Номер</th>
                        </tr>
                        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">
                                <Link :href="route('users.show', {user: user})" class="flex items-center px-4" tabindex="-1">
                                    {{ user.full_name }}
                                </Link>
                            </td>
                            <td class="border-t" colspan="2">
                                <Link :href="route('users.show', {user: user})" class="flex items-center px-4" tabindex="-1">
                                    {{ user.email }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <Link :href="route('users.show', {user: user})" class="flex items-center px-4" tabindex="-1">
                                    {{ user.phone_number }}
                                </Link>
                            </td>
                            <td class="border-t">
                                <NavLink :href="route('users.show', {user: user})" class="m-2">Изменить</NavLink>
                            </td>
                            <td class="border-t">
                                <NavLink :href="route('users.show', {user: user})" class="m-2">Удалить</NavLink>
                            </td>                       


                        </tr>
                        <tr v-if="users.length === 0">
                            <td class="px-6 py-4 border-t" colspan="4">Пользователи отсутствуют</td>
                        </tr>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>