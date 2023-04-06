<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    patronymic: user.patronymic,
    phone_number: user.phone_number,
    email: user.email,
    date_of_birth: user.date_of_birth,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Информация</h2>

            <p class="mt-1 text-sm text-gray-600">
                Обновите информацию о вашем профиле и электронной почте.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
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
                <InputLabel for="patronymic" value="Отчество" />

                <TextInput
                    id="patronymic"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.patronymic"
                    required
                    autofocus
                    autocomplete="patronymic"
                />

                <InputError class="mt-2" :message="form.errors.patronymic" />
            </div>

            <div>
                <InputLabel for="phone_number" value="Номер телефона" />

                <TextInput
                    id="phone_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone_number"
                    required
                    autofocus
                    autocomplete="phone_number"
                />

                <InputError class="mt-2" :message="form.errors.phone_number" />
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

            <div>
                <InputLabel for="date_of_birth" value="Дата рождения" />
                <!--type="date"-->
                <TextInput
                    id="date_of_birth"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.date_of_birth"
                    required
                    autofocus
                    autocomplete="date_of_birth"
                />
                <InputError class="mt-2" :message="form.errors.date_of_birth" />
            </div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
