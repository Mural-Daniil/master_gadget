<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import {  } from '@inertiajs/vue3';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    user: {
        type: Object
    },
    allPermissions: {
        type: Array
    },
    userPermissions: {
        type: Array
    },
    allRoles: {
        type: Array
    },
    userRoles: {
        type: Array
    },
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    patronymic: props.user.patronymic,
    phone_number: props.user.phone_number,
    email: props.user.email,
    permissions: props.userPermissions,
    roles: props.userRoles,
});

const destroy = (user) => {
    if (confirm('Are you sure you want to delete this user?')) {
        form.delete(route('users.destroy', {user: user}))
    }
}

const submit = () => {
    form.patch(route('users.update', {user: user}))
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Пользователи</h2>
            <p>{{ user }}</p>

            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Информация профиля</h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Обновите информацию о своих данных и электронной почте.
                    </p>
                </header>
                <form @submit.prevent="form.patch(route('users.update', {user: user}))"  class="mt-6 space-y-6">
                    <div>
                        <InputLabel for="first_name" value="Имя" />

                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.first_name"
                            required
                            autofocus
                            autocomplete="first_name"
                        />

                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>

                    <div>
                        <InputLabel for="last_name" value="Фамилия" />

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autofocus
                            autocomplete="last_name"
                        />

                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>

                    <div>
                        <InputLabel for="patronymic" value="Отчество" />

                        <TextInput
                            id="patronymic"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.patronymic"
                            autofocus
                            autocomplete="patronymic"
                        />

                        <InputError class="mt-2" :message="form.errors.patronymic" />
                    </div>

                    <div>
                        <InputLabel for="number" value="Номер телефона" />

                        <TextInput
                            id="number"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.number"
                            required
                            autofocus
                            autocomplete="number"
                        />

                        <InputError class="mt-2" :message="form.errors.number" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mt-4" v-if="allPermissions.length > 0">
                            <InputLabel for="permission" value="Разрешения" class="pb-5"/>
                            <div class="grid grid-cols-4" v-for="permission in allPermissions" :key="permission.id">
                                <label class="flex items-center" >
                                    <Checkbox name="permission" v-model:checked="form.permissions" :value="permission.id" />
                                    <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4" v-if="allRoles !== undefined && allRoles.length > 0">
                            <InputLabel for="role" value="Роли" class="pb-5"/>
                            <div class="grid grid-cols-4" v-for="role in allRoles" :key="role.id">
                                <label class="flex items-center" >
                                    <Checkbox name="role" v-model:checked="form.roles" :value="role.id" />
                                    <span class="ml-2 text-sm text-gray-600">{{ role.name }}</span>
                                </label>
                            </div>
                        </div>
                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>
                        
                            
                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
                <td class="px-6 py-4">
                    <DangerButton @click="destroy(user)">Удалить</DangerButton>
                </td>
            </section>
        </template>

    </AuthenticatedLayout>
</template>