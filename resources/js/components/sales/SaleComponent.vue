<template>
    <nav-component>
        <transition name="fade">
            <div v-if="selectedInventoryId == null && (isAdmin && !localSale.inventory_id)"
                class="flex flex-col justify-center mx-auto px-4 w-full">
                <p class="
                        border
                        w-full
                        px-4
                        py-2
                        ring-2 ring-blue-500
                        decoration-dotted
                        text-gray-700
                        rounded-sm
                        bg-indigo-100
                        mb-2
                        text-center
                    ">
                    Al ser un usuario administrador, puedes elegir el inventario
                    para realizar la venta
                </p>
                <inventory-list @click.prevent=""></inventory-list>
            </div>
            <div v-else class="w-full px-4">
                <div class="

                        flex flex-col
                        sm:flex-row
                        justify-center
                        items-baseline
                        mb-4
                    ">
                    <search-by-category class="sm:w-2/4 w-full sm:mr-2 " :categories="categories"></search-by-category>
                    <search-component class="md:w-2/4 w-full sm:mt-0 mt-4" />
                </div>
                <product-matching></product-matching>
                <div class="w-full flex flex-wrap justify-center items-center">
                    <div class="
                            bg-white
                            mt-4
                            sm:mt-0
                            px-2
                            py-2
                            w-full
                            md:mx-0
                            rounded-sm
                            shadow-sm
                        ">

                        <div class="
                                w-full
                                flex flex-wrap
                                md:justify-between
                                text-gray-600
                                md:items-center
                                mb-2
                            ">
                            <delete-sale v-if="localSale" :sale="localSale"></delete-sale>
                            <button v-if="currentSale" @click.prevent="openModal"
                                class="px-2 py-1 rounded bg-green-400 text-slate-100 font-bold hover:bg-green-600 hover:text-white">Finalizar
                                venta </button>
                            <div class="flex gap-4 flex-wrap items-center">
                                <credit-status v-if="localSale?.id" :url="`/sales/${localSale.id}`"></credit-status>
                                <sale-to-customer uri="/sales-to-clients" />
                            </div>
                        </div>
                        <div v-if="localSale" :class="[
                'flex flex-wrap px-2 py-2 items-center mb-4 border-b-2 border-blue-400',
                alignStatus,
            ]">
                            <div class="text-gray-600">
                                ID Venta - #{{ localSale?.id }}
                            </div>
                            <div class="text-xl text-green-900">
                                {{ typeOfSale }}
                            </div>
                            <div class="flex flex-wrap text-gray-600">
                                <p class="mr-2 text-xs">Status:</p>
                                <p class="text-xs">{{ localSale.status }}</p>
                            </div>
                        </div>

                        <sales-cart :sale="sale"></sales-cart>
                    </div>
                </div>
            </div>
        </transition>
        <template v-if="currentSale">
            <authentication-form model="Sale" :uri="`/user-relationship`" :id="currentSale?.id" />
        </template>
    </nav-component>
</template>
<script>
import CreditStatus from "../credits/CreditStatus.vue";
import AuthenticationForm from "../auth/AuthenticationForm.vue";
import ProductMatching from "../products/ProductMatching.vue";
import SearchComponent from "../products/SearchComponent.vue";
import InventoryList from "../inventories/InventoryList.vue";
import { mapMutations, mapGetters } from "vuex";
import SalesCart from "./SalesCart";
import NavComponent from "../NavComponent.vue";
import SaleToCustomer from "../credits/clients/SaleToCustomer.vue";
import SearchByCategory from "../products/SearchByCategory.vue";
import DeleteSale from "./DeleteSale.vue";
export default {
    components: {
        SearchComponent,
        SalesCart,
        ProductMatching,
        InventoryList,
        NavComponent,
        SaleToCustomer,
        SearchByCategory,
        DeleteSale,
        AuthenticationForm,
        CreditStatus
    },
    props: {
        sale: {
            type: Object,
        },
        categories: {
            type: Array,
        },
    },
    created() {
        if (this.sale) {
            this.sale_status = this.sale.status;
            this.localSale = this.sale;
            this.setSale(this.sale)
        }
        EventBus.$on("selected-inventory", (inventory) => {
            this.selectedInventoryId = inventory.id;
        });
        EventBus.$on("sale-deleted", (res) => {
            this.sale_status = null;
            this.localSale = null;
        });
        EventBus.$on("product-added-sales-cart", (sale) => {
            this.localSale = sale;
            this.sale_status = sale.status;
        });
        EventBus.$on("sale-to-client", (data) => {
            this.localSale = data.sale;
        });
        this.getQueryType();
    },
    data() {
        return {
            selectedInventoryId: null,
            localSale: {},
        };
    },
    methods: {
        ...mapMutations(["SET_QUERY_TYPE"]),
        ...mapMutations("sales", ["setSale"]),
        openModal() {
            EventBus.$emit(`open-modal-${this.currentSale?.id}`, true)
        },
        getQueryType() {
            let url = new URL(window.location.href);
            this.SET_QUERY_TYPE(url.searchParams.get('queryType'));
        },
    },
    computed: {
        //...mapState(["salePriceOption"]),
        ...mapGetters("sales", ["currentSale"]),
        typeOfSale() {
            return this.localSale?.client_id
                ? "Cliente " + this.localSale?.client?.name.toUpperCase()
                : "Venta a publico en general";
        },
        alignStatus() {
            return this.localSale ? "justify-between" : "justify-center";
        },
    },
};
</script>
