<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Drawer from 'primevue/drawer';

const visible = ref(true);
</script>

<template>
    <div>
        <div class="flex min-h-screen bg-primary-500">
            <Drawer v-model:visible="visible">
                <template #container="{ closeCallback }">
                    <div
                        class="flex flex-col gap-y-4 w-fit sm:w-80 h-full bg-secondary-500"
                    >
                        <div
                            class="flex items-center justify-end pr-6 pt-8 pb-2 shrink-0"
                        >
                            <button type="button" @click="closeCallback">
                                <FontAwesome
                                    class="text-xl text-gray-100"
                                    icon="xmark"
                                />
                            </button>
                        </div>

                        <hr class="border border-gray-500" />

                        <div class="flex flex-col gap-y-4 overflow-y-auto">
                            <NavLink
                                v-for="(nav, key) in $page.props.auth.sidenav"
                                :key="key"
                                :href="route(nav.route)"
                                :active="route().current(nav.route)"
                                :icon="nav.icon"
                            >
                                {{ nav.label }}
                            </NavLink>
                        </div>
                    </div>
                </template>
            </Drawer>

            <div class="flex-1 flex flex-col">
                <!-- Page Heading -->
                <header v-if="$slots.header" class="shadow bg-secondary-500">
                    <div
                        class="flex justify-between items-center mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
                    >
                        <div class="flex items-center space-x-3">
                            <button
                                class="text-gray-100 h-fit mt-1.5"
                                @click="visible = true"
                            >
                                <FontAwesome class="text-2xl" icon="bars" />
                            </button>

                            <slot name="header" />
                        </div>

                        <div class="relative ms-3">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-md border border-transparent px-3 py-2 text-base font-medium leading-4 transition duration-150 ease-in-out focus:outline-none bg-secondary-500 text-gray-400 hover:text-gray-300"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg
                                                class="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="
                                            route(
                                                'filament.admin.pages.dashboard'
                                            )
                                        "
                                    >
                                        Filament Admin
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
