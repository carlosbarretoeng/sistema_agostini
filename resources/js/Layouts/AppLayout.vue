<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import Navigation from "./Navigation.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

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
    <div>
        <Head :title="title" />

        <div class="drawer">
            <input id="drawerApp" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <div class="navbar bg-primary  sticky">
                    <div class="flex-none pr-2 sm:hidden">
                        <label for="drawerApp" class="btn btn-square btn-ghost">
                            <font-awesome-icon icon="fa-solid fa-bars" class="fa-2xl text-base-100" />
                        </label>
                    </div>
                    <div class="flex-1">
                        <a class="font-bold text-3xl uppercase text-base-100">Agostini</a>
                    </div>
                    <div class="flex-none gap-2">
                        <div class="dropdown dropdown-end">
                            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img :src="$page.props.user.profile_photo_url" alt="User Avatar" />
                                </div>
                            </label>
                            <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                                <li>
                                    <a class="justify-between" :href="route('profile.show')" :active="route().current('profile.show')">
                                        Perfil
                                    </a>
                                </li>
                                <li><a @click="logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex overflow-y-auto h-full">
                    <div class="p-2 w-56 min-h-screen hidden sm:inline-flex bg-base-100 sm:fixed">
                        <Navigation />
                    </div>
                    <div class="flex-1 sm:pl-56">
                        <header v-if="$slots.header">
                            <div class="mx-auto p-4">
                                <slot name="header" />
                            </div>
                        </header>

                        <main class="p-2">
                            <slot />
                        </main>
                    </div>
                </div>
            </div>
            <div class="drawer-side">
                <label for="drawerApp" class="drawer-overlay"></label>
                <Navigation />
            </div>
        </div>
    </div>
</template>
