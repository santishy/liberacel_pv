<template>
    <div class=" w-full">
        <nav
            class="flex items-center justify-between flex-wrap bg-red-500 p-6 fixed w-full top-0 z-10"
        >
            <div class="flex items-center flex-shrink-0 text-white mr-6 ">
                <span class="font-semibold text-xl tracking-tight">ISCO</span>
            </div>
            <div @click="toggleNavegation" class="block lg:hidden">
                <button
                    class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white"
                >
                    <svg
                        class="fill-current h-3 w-3"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div
                id="navegation"
                class="w-full block flex-grow lg:flex lg:items-center lg:w-auto hidden"
            >
                <div class="text-sm lg:flex-grow">

                    <dropdown-component
                        name="Inventario"
                        :items="InventoryMenu"
                        class="md:relative"
                    />
                    <a
                        v-if="purchase"
                        :href="purchase ? `/purchases/${purchase}` : '#'"
                        :class="highlight"
                        class="block mt-4 lg:inline-block lg:mt-0  md:hover:text-white mr-4"
                    >
                        Realizar Compra
                    </a>
                    <dropdown-component
                        name="Clientes"
                        :items="clientsMenu"
                        class="md:relative"
                    />
                    <a
                        href="/sales/create"
                        class="block mt-4 lg:inline-block lg:mt-0 text-gray-200 md:hover:text-white mr-4 md:text-base text-lg"
                    >
                        Ventas
                    </a>
                    <dropdown-component
                        name="Reportes"
                        :items="ReportsMenu"
                        class="md:relative"
                    />
                    <dropdown-component
                        name="Configuración"
                        :items="ConfigMenu"
                        class="md:relative"
                    />
                </div>
                <div class=" flex flex-wrap items-center">
                    <form
                        v-if="impersonation_id"
                        action="/impersonations"
                        method="post"
                        class="block mt-4 lg:inline-block lg:mt-0  md:hover:text-white mr-4"
                    >
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button
                            class="text-gray-300 border-red-900 border rounded px-2 py-1"
                        >
                            Regresar <i class="fas fa-user"></i>
                        </button>
                    </form>
                    <form action="/logout" method="POST">
                        <input type="hidden" name="_token" :value="crfsToken" />
                        <button
                            href="/logout"
                            class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent md:hover:text-teal-500 md:hover:bg-white mt-4 lg:mt-0"
                        >
                            {{ getCurrentUser.name }} | Salir
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
        <main class="mt-24 md:mt-32 w-ful z-0">
            <slot />
        </main>
        <notifications group="foo"></notifications>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // productsMenu: [],
            // CategoriesMenu: [
            //     {
            //         name: "Listar",
            //         url: "/categories"
            //     }
            // ],
            clientsMenu: [
                {
                    name: "Nuevo cliente",
                    url: "/clients/create"
                },
                {
                    name: "Catalago clientes",
                    url: "/clients"
                }
            ],
            InventoryMenu: [
                {
                    name: "Nuevo inventario",
                    url: "/inventories/create"
                },
                {
                    name: "Catalago almacenes",
                    url: "/warehouses"
                },
                {
                    name: "Existencias",
                    url: "/inventories"
                },
                {
                    name: "Nueva categoría",
                    url: "/categories"
                },
                {
                    name: "Nuevo producto",
                    url: "/products/create"
                },
                {
                    name: "Comprar productos",
                    url: "/products"
                }
            ],
            ReportsMenu: [
                {
                    name: "Ventas",
                    url: "/sales/"
                },
                {
                    name: "Compras",
                    url: "/purchases"
                }
            ],
            ConfigMenu: [
                {
                    name: "Nuevo usuario",
                    url: "/register/"
                },
                {
                    name: "Modificar usuario",
                    url: "/users"
                },
                {
                    name: "Nuevo rol",
                    url: "/roles/create"
                },
                {
                    name: "Contenido del ticket",
                    url: "/tickets/1/edit"
                }
            ],
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
