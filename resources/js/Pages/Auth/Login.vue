<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetCheckbox from '@/Components/Checkbox.vue';
import JetLabel from '@/Components/Label.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: 'carlosbarreto.eng@gmail.com',
    password: 'C@rlos0303',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Acessar" />

    <div class="min-h-screen flex justify-center items-center bg-primary">
        <div class="card w-80 bg-base-100 shadow-xl">
            <form @submit.prevent="submit" class="card-body">
                <h2 class="card-title">Área Restrita</h2>
                <div class="mb-4">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Usuário ou email</span>
                        </label>
                        <input v-model="form.email" type="text" placeholder="Usuário ou email" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Senha</span>
                        </label>
                        <input v-model="form.password" type="password" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>
                <div class="card-actions justify-end">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    <a class="btn btn-xs btn-block btn-secondary btn-ghost">Recuperar Senha</a>
                </div>
            </form>
        </div>
    </div>
</template>
