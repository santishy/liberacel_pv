<template>
    <div class=" w-full flex min-h-screen">
        <sidebar class="flex-shrink-0 "></sidebar>
        <div class="w-full ">
            <nav class="flex w-full max-w-full sticky  items-center justify-between flex-wrap bg-white p-6  top-0 z-10">
                <div class="flex items-center flex-shrink-0 text-white mr-6 ">
                    <span class="font-semibold text-xl tracking-tight">Liberacel</span>
                </div>
                <div @click="toggleNavegation" class="block lg:hidden">
                    <button
                        class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                        </svg>
                    </button>
                </div>
                <div id="navegation" class="w-full block sm:invisible flex-grow lg:flex lg:items-center lg:w-auto ">
                    <div class="text-sm lg:flex-grow">

                        <dropdown-component name="Inventario" :items="InventoryMenu" class="md:relative" />
                        <dropdown-component name="Egresos" :items="ExpensesMenu" class="md:relative" />
                        <a v-if="purchase" :href="purchase ? `/purchases/${purchase}` : '#'" :class="highlight"
                            class="block mt-4 lg:inline-block lg:mt-0  md:hover:text-white mr-4">
                            Realizar Compra
                        </a>
                        <dropdown-component name="Clientes" :items="clientsMenu" class="md:relative" />
                        <a href="/sales/create/?queryType=sell"
                            class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg">
                            Ventas
                        </a>
                        <a href="/refunds/create"
                            class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg">
                            Devoluciones
                        </a>
                        <dropdown-component name="Expres" :items="ExpressMenu" class="md:relative" />
                        <!-- <a
                            href="/fast-sales/create"
                            class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg"
                        >
                            Venta Expres
                        </a> -->
                        <dropdown-component name="Reportes" :items="ReportsMenu" class="md:relative" />
                        <dropdown-component name="Configuración" :items="ConfigMenu" class="md:relative" />
                    </div>
                    <div class=" flex flex-wrap items-center">
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
                                class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent md:hover:text-teal-500 md:hover:bg-white mt-4 lg:mt-0">
                                {{ getCurrentUser.name }} | Salir
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="mt-24 sm:mt-32  z-0">
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
                ? "text-lg text-black-700 border-teal-300 border-b-2"
                : "text-gray-200";
        }
    }
};
</script>
