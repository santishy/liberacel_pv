<template>
    <div v-if="products.length" class="flex flex-wrap p-2 mx-auto bg-white rounded shadow-sm md:w-9/12">
        <div class="flex flex-wrap items-center justify-between w-full px-4 py-2">
            <div>
                <span class="font-mono text-2xl text-gray-900">Nota #{{ currentFastSale.id }}</span>
            </div>
            <div>
                <span class="text-2xl font-semibold text-blue-700">Total:</span><span
                    class="text-2xl font-semibold text-blue-700">
                    {{ currentFastSale.total }}</span>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between w-full px-2 py-3">
            <button @click.prevent="openModal" :class="[statusStyle]">
                <span class="mr-2">{{
                    translate[currentFastSale.status]
                }}</span>
                <span>
                    <exchange></exchange>
                </span>
            </button>
            <p class="text-gray-700 px-2 font-semibold">
                Nuevos puntos:
                <span class="rounded-full text-white bg-blue-600 px-2 py-1">{{
                    getTotalPoints
                }}</span>
            </p>
            <span class="text-xs text-gray-700">{{
                currentFastSale.created_at
            }}</span>
        </div>
        <div class="w-full flex justify-end  items-baseline gap-4 p-2">
            <!-- <div
                class="flex flex-wrap  items-start w-80  p-1 mb-1 text-xs text-gray-800 bg-blue-200 border border-blue-600 rounded">
                <p class="mr-4">
                    Dar doble click sobre una fila de la tabla generada abajo, para
                    editar el producto.
                </p>
            </div> -->
            <customer-bonus v-if="Object.keys(currentFastSale).length" class="flex flex-wrap"
                inputStyle="form-text-input w-full">
                <template slot="bonus-button">
                    <button
                        class="flex flex-wrap items-center px-2 py-2 ml-2 font-mono text-sm text-gray-800 bg-blue-400 hover:bg-blue-600 hover:shadow-none hover:text-white hover:font-bold duration-300 rounded-sm shadow">
                        Buscar|Agregar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </button>
                </template>
            </customer-bonus>
        </div>

        <div class="relative overflow-x-auto bg-white w-full">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Cantidad</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <concept-list-item v-for="(product, index) in products" :key="product.id" :product="product"
                        :index="index" :id="localSale.id"></concept-list-item>
                </tbody>
            </table>
        </div>

        <authentication-form model="FastSale" :id="currentFastSale.id"></authentication-form>
    </div>
</template>

<script>
import ConceptListItem from "./ConceptListItem.vue";
import PointerIcon from "../icons/PointerIcon.vue";
import UserCircleIcon from "../icons/UserCircleIcon.vue";
import Exchange from "../icons/Exchange.vue";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
import CustomerBonus from "../bonuses/CustomerBonus.vue";
import { mapState, mapMutations } from "vuex";
export default {
    components: {
        ConceptListItem,
        PointerIcon,
        Exchange,
        AuthenticationForm,
        CustomerBonus,
        UserCircleIcon,
    },
    props: {
        sale: {
            type: Object,
        },
    },
    data() {
        return {
            products: [],
            localSale: {},
            translate: {
                pending: "PENDIENTE",
                completed: "COMPLETADO",
                cancelled: "CANCELADO",
            },
        };
    },
    created() {
        EventBus.$on("fast-sale", (sale) => {
            this.fillData(sale);
        });
        if (this.sale) {
            this.fillData(this.sale);
        }
        EventBus.$on("associated-user", (val) => {
            this.products = [];
            EventBus.$emit("open-modal", false);
            EventBus.$emit("focus-description");
            window.open(
                "/fast-sale-tickets/" + this.currentFastSale.id,
                "_blank"
            );
            this.SET_CURRENT_FAST_SALE({});
        });
    },
    methods: {
        ...mapMutations(["SET_CURRENT_FAST_SALE"]),
        fillData(sale) {
            this.products = sale.products;
            this.localSale = sale;
        },
        openModal() {
            EventBus.$emit("open-modal", true);
        },
    },
    computed: {
        ...mapState(["currentFastSale"]),
        statusStyle() {
            if (this.currentFastSale.status == "pending") {
                return "text-xs px-2 rounded bg-yellow-700 ring-offset-2 ring-2 font-sm text-white flex flex-wrap justify-center items-center";
            }

            return "text-xs text-green-700";
        },
        getTotalPoints() {
            let total = 0;
            if (this.currentFastSale?.product_bonuses?.length) {
                this.currentFastSale.product_bonuses.forEach((productBonus) => {
                    total += productBonus.points * productBonus.pivot.qty;
                });
            }
            return total;
        },
    },
};
</script>

