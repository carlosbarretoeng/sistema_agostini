<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import JetSectionBorder from '@/Components/SectionBorder.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout>
        <div class="grid grid-cols-1 sm:grid-cols-4 sm:gap-4">
            <div>
                <div class="card w-full bg-base-100 shadow-md mb-4">
                    <div class="aspect-w-2 aspect-h-2">
                        <div class="indicator">
                        <span class="indicator-item indicator-bottom indicator-center btn btn-xs btn-secondary text-white btn-block w-1/2">
                            <i class="fa-solid fa-camera mr-2"></i> Alterar Imagem
                        </span>
                        </div>
                        <img :src="$page.props.user.profile_photo_url" alt="Shoes" />
                    </div>

                    <div class="pt-6 p-4">
                        <h2 class="card-title">{{ $page.props.user.name }}</h2>
                        <p>{{ $page.props.user.email }}</p>
                        <div class="text-2xs">{{ $page.props.user.current_team.name }}</div>
                    </div>
                </div>
            </div>
            <div class="col-span-3">
                <div class="card w-full bg-base-100 shadow-md mb-4">
                    <div class="card-body">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <h2 class="card-title">Informações do Perfil</h2>
                                <p class="text-sm">Atualize suas informações do perfil e o endereço de email</p>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nome Completo</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Endereço de Email</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </div>
                        </div>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </div>

                <div class="card w-full bg-base-100 shadow-md mb-4">
                    <div class="card-body">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <h2 class="card-title">Atualização de Senha</h2>
                                <p class="text-sm">Garanta que a sua conta esta usando uma senha longa e aleatória para manter sua segurança.</p>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nova Senha</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Repetir Senha</span>
                                </label>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </div>
                        </div>
                        <div class="card-actions justify-end">
                            <button class="btn btn-primary">Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
