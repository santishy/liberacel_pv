<template>


    <div>
        <!-- Overlay -->
        <div v-if="isOpen" class="absolute sm:fixed inset-0 bg-black bg-opacity-50 z-20 transition-opacity duration-300"
            @click="closeDropdown"></div>
        <aside ref="sidebar" :class="[isOpen ? 'w-80 px-2 py-4' : 'w-0 sm:w-10 ', ' sm:block']"
            @mouseenter="isOpen = true" @mouseleave="closeDropdown"
            class="min-h-full shadow h-screen scroll-smooth scrollbar-track-transparent  scrollbar-thumb-sky-500 scrollbar-thin z-25 bg-white sm:px-2 sm:py-4 sm:ml-0 fixed duration-300 overflow-x-hidden overflow-y-auto hover:w-80">
            <div class="w-full overflow-x-hidden overflow-y-auto ">
                <h3 :class="[isOpen ? 'p-2' : 'p-1 bg-sky-100']"
                    class="text-sky-500 overflow-hidden text-center font-mono text-xl mb-16 border border-purple-200 rounded-sm">
                    <span v-if="isOpen"> {{ appName }} </span>
                    <span v-else class="x text-sky-700 font-bold"> {{ appName.charAt(0) }}</span>
                </h3>
                <dropdown title="Inventario" :menu="InventoryMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                        </svg>
                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Expres" :menu="ExpressMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Egresos" :menu="ExpensesMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>

                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Clientes" :menu="clientsMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Créditos" :menu="CreditsMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg fill="none" stroke="currentColor" class="w-6 h-6" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z">
                            </path>
                        </svg>
                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Reportes" :menu="ReportsMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </template>
                </dropdown>
                <dropdown class="mt-4" title="Configuración" :menu="ConfigMenu" title-font-color="text-slate-700"
                    item-font-color="text-gray-700">
                    <template slot="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </template>
                </dropdown>
            </div>
        </aside>
    </div>
</template>

<script>
import {
    clientsMenu,
    ConfigMenu,
    ExpensesMenu,
    ExpressMenu,
    InventoryMenu,
    ReportsMenu,
    CreditsMenu,
} from "../../utilities/menuData.js";
import ArrowLeft from "../icons/ArrowLeft.vue";
import Dropdown from "../partials/Dropdown.vue";
import { mapState } from "vuex"
export default {
    components: { ArrowLeft, Dropdown },

    data() {
        return {
            clientsMenu,
            ConfigMenu,
            ExpensesMenu,
            ExpressMenu,
            InventoryMenu,
            ReportsMenu,
            CreditsMenu,
            isOpen: false,
        };
    },

    mounted() {
        EventBus.$on('toggle-sidebar', this.toggleIsOpen);
        document.addEventListener('click', this.handleClickOutside);
    },
    beforeDestroy() {
        document.removeEventListener('click', this.handleClickOutside);
    },
    methods: {
        toggleIsOpen() {
            this.isOpen = !this.isOpen;
        },
        closeDropdown() {
            this.isOpen = false;
            EventBus.$emit('close-dropdown');
            console.log(this.isOpen)
        },
        handleClickOutside(event) {

            const isMobile = window.innerWidth <= 768; // Ajusta el ancho según tus necesidades
            const sidebar = this.$refs.sidebar;
            const buttonMenu = document.querySelector("#buttonMenu");
            if (!buttonMenu.contains(event.target) && isMobile && this.isOpen && !sidebar.contains(event.target)) {
                this.closeDropdown();
            }
        },
    },
    computed: {
        ...mapState(["appName"]),
    }
};
</script>

<style scoped></style>
