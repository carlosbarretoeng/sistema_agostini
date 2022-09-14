<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: 'carlosbarreto.eng@gmail.com',
});

let successMessage = ref(null);
let errorMessage = ref(null);

const submit = () => {
    form.post(route('password.email'), {
        onError: (err) => {
            errorMessage.value = Object.values(err).pop();
            form.reset();
            setTimeout(() => errorMessage.value = null, 5000);
        },
        onSuccess: () => {
            successMessage.value = "Mensagem enviada! Verifique sua caixa de entrada!";
            setTimeout(() => successMessage.value = null, 5000);
        }
    });
};
</script>

<template>
    <Head title="Recuperar Senha" />

    <div v-if="errorMessage" class="absolute bottom-0 w-full p-2">
        <div class="alert alert-error shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ errorMessage }}</span>
            </div>
        </div>
    </div>

    <div v-if="successMessage" class="absolute bottom-0 w-full p-2">
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>{{ successMessage }}</span>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex justify-center items-center bg-primary">
        <div class="card w-80 bg-base-100 shadow-xl">
            <form @submit.prevent="submit" class="card-body">
                <h2 class="card-title">Recuperar Senha</h2>
                <span>
                    Esqueceu a sua senha? Sem problemas. Nos informe o email cadastrado
                    que lhe enviaremos uma mensagem com as instruções para escolhar uma
                    nova senha.
                </span>
                <div class="mb-4">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input v-model="form.email" type="text" placeholder="Email" class="input input-bordered w-full max-w-xs" />
                    </div>
                </div>
                <div class="card-actions justify-end">
                    <button type="submit" class="btn btn-primary btn-block">Recuperar senha</button>
                    <a :href="route('login')" class="btn btn-xs btn-block btn-secondary btn-ghost">Voltar para tela de acesso</a>
                </div>
            </form>
        </div>
    </div>
</template>
