<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    status: {
        type: String,
    },

    allPermissions: {
        type: Array
    },
});

const form = useForm({
    name: '',
    permissions: [],
});
</script>

<template>
    <Head title="Новая роль" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавление роли</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.get(route('store-role'))" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Название" /> 

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />

                            <div class="mt-4" >
                                <InputLabel for="permission" value="Разрешения" class="pb-5"/>
                                    <div class="grid grid-cols-4" v-for="permission in props.allPermissions" :key="permission.id">
                                        <label class="flex items-center" >
                                            <Checkbox name="permission" v-model:checked="form.permissions" :value="permission.id" />
                                            <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                                        </label>
                                    </div>
                             </div>
                        </div>
            
                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
