<template>
    <div
        v-show="products.length"
        class="
            flex flex-wrap
            items-baseline
            p-2
            mx-auto
            bg-white
            border-l-4 border-teal-400
            rounded-sm
            shadow-sm
            md:w-9/12
        "
    >
        <div
            class="
                flex flex-wrap
                items-center
                justify-between
                w-full
                px-4
                py-2
                border-b border-gray-300
            "
        >
            <div>
                <span class="font-mono text-2xl text-teal-800"
                    >Nota #{{ localSale.id }}</span
                >
            </div>

            <customer-bonus
                v-if="localSale"
                class="flex flex-wrap"
                :fast-sale="localSale"
                inputStyle="bg-gray-300 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 placeholder-gray-600"
            >
                <template slot="bonus-button">
                    <button
                        class="
                            flex flex-wrap
                            items-center
                            px-2
                            py-2
                            ml-2
                            font-mono
                            text-sm text-gray-700
                            bg-teal-200
                            rounded-sm
                            shadow
                        "
                    >
                        Buscar/Agregar
                        <user-circle-icon></user-circle-icon>
                    </button>
                </template>
            </customer-bonus>
            <span class="text-2xl font-light text-red-700"
                >Total: {{ localSale.total }}</span
            >
        </div>

        <div
            class="flex flex-wrap items-center justify-between w-full px-2 py-3"
        >
            <button @click.prevent="openModal" :class="[statusStyle]">
                <span class="mr-2">{{ translate[localSale.status] }}</span>
                <span><exchange></exchange></span>
            </button>
            <p
                class="text-gray-700 px-2 font-semibold"
                >Nuevos puntos: <span class="rounded-full text-white bg-blue-600 px-2 py-1">{{ getTotalPoints }}</span></p
            >
            <span class="text-xs text-gray-700">{{
                localSale.created_at
            }}</span>
        </div>
        <div
            class="
                flex flex-wrap
                items-center
                justify-center
                w-full
                p-1
                mb-1
                text-xs text-gray-800
                bg-blue-200
                border border-blue-600
                rounded
            "
        >
            <p class="mr-4">
                Dar doble click sobre una fila de la tabla generada abajo, para
                editar el producto.
            </p>

            <pointer-icon class="text-blue-700"></pointer-icon>
            <pointer-icon class="text-blue-700"></pointer-icon>
        </div>
        <table
            class="
                flex flex-row flex-no-wrap
                w-full
                overflow-hidden
                rounded
                sm:bg-white
            "
        >
            <thead class="text-white">
                <tr
                    class="
                        flex flex-col
                        mb-2
                        bg-teal-400
                        rounded-l-lg
                        flex-no
                        wrap
                        sm:table-row sm:rounded-none sm:mb-0
                    "
                >
                    <th class="p-3 text-left sm:text-center">Descripción</th>
                    <th class="p-3 text-left sm:text-center">Precio</th>
                    <th class="p-3 text-left sm:text-center">Cantidad</th>
                    <th class="p-3 text-left sm:text-center" width="110px">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <concept-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :product="product"
                    :index="index"
                    :id="localSale.id"
                ></concept-list-item>
            </tbody>
        </table>

        <authentication-form
            model="FastSale"
            :id="localSale.id"
        ></authentication-form>
    </div>
</template>

<script>
import ConceptListItem from "./ConceptListItem.vue";
import PointerIcon from "../icons/PointerIcon.vue";
import UserCircleIcon from "../icons/UserCircleIcon.vue";
import Exchange from "../icons/Exchange.vue";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
import CustomerBonus from "../bonuses/CustomerBonus.vue";

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
            window.open("/fast-sale-tickets/" + this.localSale.id, "_blank");
        });
    },
    methods: {
        fillData(sale) {
            this.products = sale.products;
            this.localSale = sale;
        },
        openModal() {
            EventBus.$emit("open-modal", true);
        },
    },
    computed: {
        statusStyle() {
            if (this.localSale.status == "pending") {
                return "text-xs px-2 rounded bg-yellow-700 ring-offset-2 ring-2 font-sm text-white flex flex-wrap justify-center items-center";
            }

            return "text-xs text-green-700";
        },
        getTotalPoints() {
            let total = 0;
            if (this.localSale?.product_bonuses?.length) {
                this.localSale.product_bonuses.forEach((productBonus) => {
                    total += productBonus.points * productBonus.pivot.qty;
                });
            }
            return total;
        },
    },
};
</script>
<style lang="css">
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
</style>
