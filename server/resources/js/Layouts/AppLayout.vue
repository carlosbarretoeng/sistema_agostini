<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};

</script>

<template>
    <div class="drawer">
        <input id="appdrawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col bg-base-100">
            <div class="w-full navbar bg-primary text-white z-50">
                <div class="flex-none lg:hidden">
                    <label for="appdrawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1 sm:flex-none px-2 mx-2 text-2xl font-bold">Agostini</div>
                <div class="divider divider-horizontal hidden sm:block"></div>
                <div class="flex-1 hidden lg:block">
                    <ul class="menu menu-horizontal dropdown-content">
                        <li><a :href="route('dashboard')">Início</a></li>
                        <li tabindex="0">
                            <a class="justify-between">
                                Empresas
                                <i class="fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="mt-0 p-2 text-black shadow menu menu-compact dropdown-content bg-base-100 rounded-box">
                                <li><a :href="route('empresa.index')">Cadastro</a></li>
                                <li><a>Departamentos</a></li>
                                <li><a>Setores</a></li>
                                <li><a>Maquinário</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="flex-none dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost">
                        <div class="flex items-center space-x-3">
                            <div class="text-right text-xs hidden sm:block">
                                <div class="font-bold">{{ $page.props.user.name }}</div>
                                <div class="text-2xs opacity-50">{{ $page.props.user.email }}</div>
                            </div>
                            <div class="avatar">
                                <div class="mask mask-squircle w-10 h-10">
                                    <img :src="$page.props.user.profile_photo_url" alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                        </div>
                    </label>
                    <ul tabindex="0" class="mt-3 p-2 text-black shadow menu menu-compact dropdown-content bg-base-100 rounded-box">
                        <li><a :href="route('profile.show')">Meu perfil</a></li>
                        <li><a @click="logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <main class="mx-4 mt-4">
                <slot />
            </main>
        </div>
        <div class="drawer-side">
            <label for="appdrawer" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-100">
                <li><a :href="route('dashboard')">Início</a></li>
            </ul>

        </div>
    </div>
</template>
