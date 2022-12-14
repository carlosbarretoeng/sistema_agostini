<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import Navigation from "./Navigation.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const showSubmenu = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const showDrawer = () => {
    return !Inertia.page.props.user.roles[0].name.startsWith('app_');
}

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <div v-if="Object.keys($page.props.errors).length" class="absolute bottom-0 pl-56 w-full">
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <ul>
                        <li v-for="(error, index) in $page.props.errors" :key="index">{{ error }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="drawer">
            <input id="drawerApp" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col">
                <!-- Navbar -->
                <div class="navbar bg-primary  sticky">
                    <div v-if="showDrawer()" class="flex-none pr-2 sm:hidden">
                        <label for="drawerApp" class="btn btn-square btn-ghost">
                            <font-awesome-icon icon="fa-solid fa-bars" class="fa-2xl text-base-100" />
                        </label>
                    </div>
                    <div class="flex-1">
                        <a class="font-bold text-3xl uppercase text-base-100">Agostini</a>
                    </div>
<!--                    <div class="flex-none gap-2">-->
<!--                        <div class="dropdown dropdown-end">-->
<!--                            <label tabindex="0" class="btn btn-ghost btn-circle avatar">-->
<!--                                <div class="w-10 rounded-full">-->
<!--                                    <img :src="$page.props.user.profile_photo_url" alt="User Avatar" />-->
<!--                                </div>-->
<!--                            </label>-->
<!--                            <ul tabindex="0"-->
<!--                                class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">-->
<!--                                <li class=""><a @click="logout">Sair</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar" @click="evt => showSubmenu = !showSubmenu">
                        <div class="w-10 rounded-full">
                            <img :src="$page.props.user.profile_photo_url" alt="User Avatar" />
                        </div>
                    </label>
                </div>

                <div class="flex overflow-y-auto h-full">
                    <div v-if="showDrawer()" class="w-56 min-h-screen hidden sm:inline-flex bg-base-100 sm:fixed">
                        <Navigation />
                    </div>
                    <div class="flex-1" :class="{'sm:pl-56': showDrawer() }">
                        <div class="mx-2 mt-2" v-if="showSubmenu">
                            <ul tabindex="0"
                                class="p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-full">
                                <li class=""><a @click="logout">Sair</a></li>
                            </ul>
                        </div>

                        <header v-if="$slots.header">
                            <div class="flex mx-auto p-4 bg-base-300">
                                <h1 class="flex-1 py-3 font-semibold text-xl text-gray-800 leading-tight">
                                    <slot name="header" />
                                </h1>
                                <div class="flex-none">
                                    <slot name="actions" />
                                </div>
                            </div>
                        </header>

                        <main class="p-2">
                            <slot />
                        </main>
                    </div>
                </div>
            </div>
            <div v-if="showDrawer()" class="drawer-side">
                <label for="drawerApp" class="drawer-overlay"></label>
                <Navigation />
            </div>
        </div>
    </div>
</template>
