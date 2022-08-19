<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';

const form = useForm({
    email: 'carlosbarreto.eng@gmail.com',
    password: 'C@rlos0303',
})
</script>

<template>
    <Head title="Acesso" />
    <div class="w-full min-h-screen flex justify-center items-center bg-base-200">
        <div class="card w-80 bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Área Administrativa</h2>
                <form @submit.prevent="form.post('/login', { onFinish: () => form.reset('password') })">
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input v-model="form.email" type="text" placeholder="Email" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="form-control w-full max-w-xs">
                        <label class="label">
                            <span class="label-text">Senha</span>
                        </label>
                        <input v-model="form.password" type="password" placeholder="Senha" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="card-actions mt-4">
                        <button class="btn btn-primary btn-block" type="submit" :class="{ 'loading': form.processing }">{{ !form.processing ? 'Entrar' : '' }}</button>
                        <button class="btn btn-sm btn-primary btn-outline btn-block">Recuperar Senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
