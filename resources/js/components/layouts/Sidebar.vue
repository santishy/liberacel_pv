<template>
    <aside
        :class="[isOpen ? 'w-72' : 'w-20']"
        class="min-h-full bg-purple-600 px-2 py-4 relative duration-300"
    >
        <div class="w-full inset-y-0 sticky">
            <div
                @click="toggleIsOpen"
                class="absolute -right-3 cursor-pointer rounded-full bg-white border border-gray-900 z-30"
            >
                <arrow-left />
            </div>
            <h3
                class="text-white text-center font-medium mb-16 p-2 border border-gray-700 rounded-sm"
            >
                Liberacel
            </h3>
            <dropdown
                title="Inventario"
                :menu="InventoryMenu"
                title-font-color="text-purple-300"
                item-font-color="text-purple-700"
            >
                <template slot="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="1em"
                        height="1em"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"
                        />
                    </svg>
                </template>
            </dropdown>
            <dropdown
                class="mt-4"
                title="Expres"
                :menu="ExpressMenu"
                title-font-color="text-purple-300"
                item-font-color="text-purple-700"
            >
                <template slot="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"
                        />
                    </svg>
                </template>
            </dropdown>
            <dropdown
                class="mt-4"
                title="Egresos"
                :menu="ExpensesMenu"
                title-font-color="text-purple-300"
                item-font-color="text-purple-700"
            >
                <template slot="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"
                        />
                    </svg>
                </template>
            </dropdown>
            <dropdown
                class="mt-4"
                title="Clientes"
                :menu="clientsMenu"
                title-font-color="text-purple-300"
                item-font-color="text-purple-700"
            >
                <template slot="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                        />
                    </svg>
                </template>
            </dropdown>
        </div>
    </aside>
</template>

<script>
import {
    clientsMenu,
    ConfigMenu,
    ExpensesMenu,
    ExpressMenu,
    InventoryMenu,
    ReportsMenu,
} from "../../utilities/menuData.js";
import ArrowLeft from "../icons/ArrowLeft.vue";
import Dropdown from "../partials/Dropdown.vue";
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
            isOpen: true,
        };
    },
    methods: {
        toggleIsOpen() {
            console.log("isOpen");
            this.isOpen = !this.isOpen;
        },
    },
};
</script>

<style scoped></style>
