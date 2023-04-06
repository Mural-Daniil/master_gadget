<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    permission: {
        type: Object,
    },
});

const form = useForm({
    name: props.permission.name,
});
</script>

<template>
    <Head title="Изменить разрешение" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изменить разрешение</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('update-permission', props.permission.id))" class="mt-6 space-y-6">
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
