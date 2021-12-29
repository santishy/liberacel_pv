<template>
    <div
        v-if="products.length"
        class="
            p-2
            border-l-4 border-teal-400
            flex flex-wrap
            items-baseline
            md:w-9/12
            mx-auto
            bg-white
            shadow-sm
            rounded-sm
        "
    >
        <h3
            class="
                border-b border-gray-300
                px-4
                w-full
                font-mono
                text-2xl text-teal-800
            "
        >
            Nota #{{ nota }}
        </h3>
        <div
            class="flex flex-wrap justify-between items-center py-3 px-2 w-full"
        >
            <button @click.prevent="openModal" :class="[statusStyle]">
                <span class="mr-2">{{ translate[status] }}</span>
                <span><exchange></exchange></span></button
            ><span class="text-2xl font-light text-red-700"
                >Total: {{ total }}</span
            ><span class="text-xs text-gray-700">{{ currentDate }}</span>
        </div>
        <div
            class="
                bg-blue-200
                w-full
                rounded
                p-1
                mb-1
                text-gray-800 text-xs
                flex flex-wrap
                justify-center
                items-center
                border border-blue-600
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
                w-full
                flex flex-row flex-no-wrap
                sm:bg-white
                rounded
                overflow-hidden
            "
        >
            <thead class="text-white">
                <tr
                    class="
                        bg-teal-400
                        flex flex-col flex-no
                        wrap
                        sm:table-row
                        rounded-l-lg
                        sm:rounded-none
                        mb-2
                        sm:mb-0
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
                    :id="id"
                ></concept-list-item>
            </tbody>
        </table>

        <authentication-form model="FastSale" :id="nota"></authentication-form>
    </div>
</template>

<script>

import ConceptListItem from "./ConceptListItem.vue";
import PointerIcon from "../icons/PointerIcon.vue";
import Exchange from "../icons/Exchange.vue";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
export default {
    components: {
        ConceptListItem,
        PointerIcon,
        Exchange,
        AuthenticationForm,
       
    },
    props: {
        sale: {
            type: Object,
        },
    },
    data() {
        return {
            products: [],
            nota: null,
            status: null,
            total: null,
            currentDate: null,
            id: null,
            translate: {
                pending: "PENDIENTE",
                completed: "COMPLETADO",
                cancelled: "CANCELADO",
            },
        };
    },
    created() {
        EventBus.$on("fast-sale", (sale) => {
            if (!this.sale) {
                this.sale = sale;
            }
            this.fillData(sale);
        });
        if (this.sale) {
            this.fillData(this.sale);
        }
    },
    methods: {
        fillData(sale) {
            this.products = sale.products;
            this.nota = sale.id;
            this.status = sale.status;
            this.total = sale.total;
            this.id = sale.id;
            this.currentDate = sale.created_at;
        },
        openModal() {
            EventBus.$emit("open-modal", true);
        },
        // toggleStatus(event) {
        //     if (event.target.checked) {
        //         EventBus.$emit("toggle-status", "cancelled");
        //     } else {
        //         EventBus.$emit("toggle-status", "completed");
        //     }
        // },
    },
    computed: {
        statusStyle() {
            if (this.status == "pending") {
                return "text-xs px-2 rounded bg-yellow-700 ring-offset-2 ring-2 font-sm text-white flex flex-wrap justify-center items-center";
            }

            return "text-xs text-green-700";
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
