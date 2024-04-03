<template>
    <div class=" w-full flex min-h-screen">
        <sidebar class="flex-shrink-0 "></sidebar>
        <div class="w-full min-h-screen">
            <nav class="flex w-full max-w-full sticky  items-center justify-between flex-wrap bg-white p-4  top-0 z-10">
                <div @click="toggleNavegation" class="block lg:hidden">
                    <button
                        class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                    </button>
                </div>
                <div id="navegation" class="w-full block flex-grow lg:flex lg:items-center lg:w-auto ">
                    <div class="text-sm lg:flex-grow  flex justify-center">
                        <!-- <dropdown-component name="Inventario" :items="InventoryMenu" class="md:relative" /> -->
                        <!-- <dropdown-component name="Egresos" :items="ExpensesMenu" class="md:relative" /> -->
                        <a v-if="purchase" :href="purchase ? `/purchases/${purchase}` : '#'" :class="highlight"
                            class="block rounded bg-green-500 px-2 py-1 animate-pulse mt-4 relative lg:inline-block lg:mt-0   mr-4">
                            Finalizar Compra
                        </a>


                        <!-- <dropdown-component name="Clientes" :items="clientsMenu" class="md:relative" /> -->
                        <a href="/sales/create/?queryType=sell"
                            class="flex relative border-center justify-center mt-4 items-center lg:mt-0 text-gray-600 sm:hover:text-gray-800 mr-4 md:text-base text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span
                                class="before:absolute before:bottom-1 before:h-px before:w-0 before:bg-gradient-to-r before:from-transparent before:to-gray-500 before:transition-all before:duration-500 hover:before:w-full"></span>
                            Ventas Stock

                        </a>
                        <a href="/fast-sales/create"
                            class="flex items-center relative border-center justify-center mt-4 lg:mt-0 text-gray-600 sm:hover:text-gray-800 mr-4 md:text-base text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                            Ventas Expres
                        </a>
                        <a href="/checkout"
                            class="flex items-center relative border-center justify-center mt-4 lg:mt-0 text-gray-600 sm:hover:text-gray-800 mr-4 md:text-base text-lg">
                            <svg class="w-4 h-4 mr-2" data-slot="icon" fill="none" stroke-width="1.5"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z">
                                </path>
                            </svg>
                            Caja
                        </a>
                        <!-- <a href="/refunds/create"
                            class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg">
                            Devoluciones
                        </a> -->
                        <!-- <dropdown-component name="Expres" :items="ExpressMenu" class="md:relative" /> -->

                        <!-- <dropdown-component name="Reportes" :items="ReportsMenu" class="md:relative" /> -->
                        <!-- <dropdown-component name="Configuración" :items="ConfigMenu" class="md:relative" /> -->
                    </div>
                    <div class=" flex flex-wrap items-center ">
                        <form v-if="impersonation_id" action="/impersonations" method="post"
                            class="block mt-4 lg:inline-block lg:mt-0  md:hover:text-white mr-4">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" :value="crfsToken" />
                            <button class="text-gray-300 border-red-900 border rounded px-2 py-1">
                                Regresar <i class="fas fa-user"></i>
                            </button>
                        </form>
                        <form action="/logout" method="POST">
                            <input type="hidden" name="_token" :value="crfsToken" />
                            <button href="/logout"
                                class="flex  hover:bg-gray-400 shadow hover:shadow-none hover:font-bold  transition-all duration-300 text-sm px-4 py-2 leading-none border font-medium items-center justify-center rounded text-gray-800 bg-gray-200 mt-4 lg:mt-0">
                                {{ getCurrentUser.name }}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="mt-8 z-0 px-12 py-4">
                <slot />
            </main>
            <notifications group="foo"></notifications>
        </div>
    </div>
</template>
<script>
import menuData from '../utilities/menuData';
import Sidebar from './layouts/Sidebar.vue'
export default {
    components: { Sidebar },
    data() {
        return {
            ...menuData,
            crfsToken: document.querySelector('meta[name="csrf-token"]')
                .content,
            purchase: false,
            impersonation_id: document.querySelector(
                'meta[name="impersonation_id"]'
            ).content
        };
    },
    created() {
        this.cleanLocalStorage();
    },
    mounted() {
        this.purchase = document.head.querySelector(
            'meta[name="purchase_id"]'
        ).content;
        EventBus.$on("purchase-created", this.setPurchaseId);
        this.cleanLocalStorage();
    },
    methods: {
        toggleNavegation() {
            document.querySelector("#navegation").classList.toggle("hidden");
        },
        setPurchaseId(id) {
            this.purchase = id;
        },
        cleanLocalStorage() {
            if (
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == "" ||
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == null
            )
                localStorage.removeItem("productsInPurchase");
        }
    },
    computed: {
        highlight() {
            return this.purchase
                ? "text-lg text-white hover:animate-none"
                : "text-gray-200";
        }
    }
};
</script>
