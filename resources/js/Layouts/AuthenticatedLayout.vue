<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref, watch, onMounted, computed } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import { FontAwesomeIcon as FontAwesome } from '@fortawesome/vue-fontawesome';

const SIDEBAR_STATE_KEY = 'sidebar-open';

const sidebarOpen = ref(true);

onMounted(() => {
    const savedState = localStorage.getItem(SIDEBAR_STATE_KEY);
    sidebarOpen.value = savedState === null ? true : savedState === 'true';
});

watch(sidebarOpen, (newVal) => {
    localStorage.setItem(SIDEBAR_STATE_KEY, newVal);
});

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const sidebarIcon = computed(() => {
    return sidebarOpen.value ? 'circle-chevron-left' : 'circle-chevron-right';
});

const isDesktop = ref(window.innerWidth >= 768);
window.addEventListener('resize', () => {
    isDesktop.value = window.innerWidth >= 768;
});
</script>

<template>
    <div class="relative md:flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside
            :class="[
                'bg-secondary-500 text-white transition-all duration-300 ease-in-out z-50',
                sidebarOpen ? 'w-64' : 'w-16',
                // Fixed and overlay on small screens
                'fixed inset-y-0 left-0 md:relative',
                sidebarOpen ? 'block' : 'block', // Always show the bar
            ]"
            :style="{
                transform:
                    sidebarOpen || isDesktop
                        ? 'translateX(0)'
                        : 'translateX(-90%)',
            }"
        >
            <div class="h-full flex flex-col">
                <nav class="flex-1 mt-2">
                    <ul>
                        <NavLink
                            v-for="(nav, key) in $page.props.auth.sidenav"
                            :key="key"
                            :href="route(nav.route)"
                            :active="route().current(nav.route)"
                            :icon="nav.icon"
                            class="text-nowrap overflow-hidden"
                        >
                            {{ sidebarOpen ? nav.label : null }}
                        </NavLink>
                    </ul>
                </nav>
            </div>

            <!-- Toggle Bar + Button -->
            <div
                class="absolute top-0 right-0 h-full w-2 group cursor-pointer transition-colors duration-300"
                :class="sidebarOpen ? 'bg-tertiary-400/70' : 'bg-secondary-400'"
                @click="toggleSidebar"
            >
                <div
                    class="absolute top-14 right-[-14px] w-6 h-6 bg-secondary-500 rounded-full flex items-center justify-center transition-transform duration-300"
                >
                    <FontAwesome :icon="sidebarIcon" size="xl" />
                </div>
            </div>
        </aside>

        <main class="flex-1 transition-all duration-300 ease-in-out">
            <header v-if="$slots.header" class="shadow bg-secondary-500">
                <div
                    class="flex justify-between items-center mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
                >
                    <slot name="header" />

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
                                        route('filament.admin.pages.dashboard')
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

            <div class="h-full bg-primary-500 text-white pt-6">
                <slot />
            </div>
        </main>
    </div>
</template>
