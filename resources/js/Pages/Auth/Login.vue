<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

let showPassword = ref(false);

let errorMessage = ref(null);

const form = useForm({
    identify: '',
    password: ''
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onError: (err) => {
            console.log( Object.values(err).pop() )
            errorMessage.value = Object.values(err).pop();
            form.reset();
            setTimeout(() => errorMessage.value = null, 5000);
        },
        onFinish: (el) => {
            form.reset(['identify', 'password'])
        }
    });
};
</script>

<template>
    <Head title="Acessar" />

    <div v-if="errorMessage" class="absolute bottom-0 w-full p-2">
        <div class="alert alert-error shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ errorMessage }}</span>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex justify-center items-center bg-primary">
        <div class="card w-80 bg-base-100 shadow-xl">
            <form @submit.prevent="submit" class="card-body">
                <h2 class="card-title">Área Restrita</h2>
                <div class="mb-4">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Usuário ou Email</span>
                        </label>
                        <input v-model="form.identify" type="text" placeholder="Usuário ou email" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Senha</span>
                        </label>
                        <div class="flex">
                            <input v-model="form.password" :type="showPassword ? 'text' : 'password'" placeholder="Senha" class="input input-bordered w-full max-w-xs" />
                            <button type="button" class="btn" @click="() => showPassword = !showPassword">
                                <font-awesome-icon :icon="!showPassword ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-actions justify-end">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                    <a v-if="canResetPassword" :href="route('password.request')" class="btn btn-xs btn-block btn-secondary btn-ghost">Recuperar Senha</a>
                </div>
            </form>
        </div>
    </div>
</template>
