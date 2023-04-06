<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    service: {
        type: Object,
    },
});

const form = useForm({
    title: props.service.title,
    category: props.service.category,
    about: props.service.about,
    min_price: props.service.min_price,
    price: props.service.price,
});
</script>

<template>
    <Head title="Услуга" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Услуга</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="form.post(route('update-service', props.service.id))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Название" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>
            
            <div>
                <InputLabel for="category" value="Категория" />

                <TextInput
                    id="category"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.category"
                    required
                    autofocus
                    autocomplete="category"
                />

                <InputError class="mt-2" :message="form.errors.category" />
            </div>

            <div>
                <InputLabel for="about" value="Описание" />

                <TextInput
                    id="about"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.about"
                    required
                    autofocus
                    autocomplete="about"
                />

                <InputError class="mt-2" :message="form.errors.about" />
            </div>

            <div>
                <InputLabel for="min_price" value="Минимальная цена" />

                <TextInput
                    id="min_price"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.min_price"
                    required
                    autofocus
                    autocomplete="min_price"
                />

                <InputError class="mt-2" :message="form.errors.min_price" />
            </div>

            <div>
                <InputLabel for="price" value="Цена" />

                <TextInput
                    id="price"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.price"
                    required
                    autofocus
                    autocomplete="price"
                />

                <InputError class="mt-2" :message="form.errors.price" />
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
