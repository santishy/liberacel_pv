<template>
    <nav-component>
        <div
            class="grid md:grid-cols-5  mt-24 md:mt-32 grid-flow-row mx-auto w-11/12"
        >
            <div
                class="col-span-5 flex justify-between items-center row-span-1  bg-white px-2 py-2"
            >
                <div class="text-xl text-gray-800 ml-4">
                    <span class="text-2x text-gray-600">Status:</span>
                    <span class="text-2x text-blue-600 font-semibold">{{
                        translateStatus
                    }}</span>
                </div>
                <div>
                    <complete-purchase-btn
                        :purchase="purchase"
                        :total-purchase="localTotalPurchase"
                    />
                    <cancel-purchase-btn :id="purchase.id" />
                </div>

                <div class="text-xl text-gray-800 mr-4">
                    <span class="text-2xl">Total Compra:</span>
                    <span class="text-2xl font-semibold"
                        >${{
                            new Intl.NumberFormat("es-MX").format(
                                localTotalPurchase
                            )
                        }}</span
                    >
                </div>
            </div>
            <div
                v-if="isAdmin && !user.inventory_id"
                class="bg-white border-b border-t border-blue-400 px-4 py-2 text-gray-700  text-center col-span-5"
            >
                <div class="grid md:grid-cols-5 grid-cols-1 ">
                    <h3 class="text-xl mb-2 text-center col-span-5">
                        Elige un almacén
                    </h3>
                    <label
                        v-for="inventory in inventories"
                        class="flex mr-2 mb-2 items-center rounded-md border border-teal-500 py-2 justify-center"
                        :key="inventory.id"
                        @click="selectedInventory(inventory)"
                    >
                        <span class="mr-2">{{ inventory.name }}</span>
                        <input
                            type="radio"
                            name="inventory_id"
                            class="form-radio"
                            :value="inventory.id"
                        />
                    </label>
                </div>
            </div>

            <product-list
                :products="localProductsInPurchase"
                class="col-span-5 mt-4"
            >
            </product-list>
        </div>
    </nav-component>
</template>
<script>
import CompletePurchaseButton from "./CompletePurchaseButton.vue";
import CancelPurchaseButton from "./CancelPurchaseButton";
import NavComponent from "../NavComponent.vue";
import ProductList from "./ProductList.vue";

export default {
    components: {
        "complete-purchase-btn": CompletePurchaseButton,
        "cancel-purchase-btn": CancelPurchaseButton,
        NavComponent,
        ProductList
    },
    props: {
        productsInPurchase: {
            type: Array
        },
        totalPurchase: {
            type: Number
        },
        purchase: {
            type: Object
        },
        inventories: {
            type: Array
        }
    },
    data() {
        return {
            localProductsInPurchase: this.productsInPurchase,
            localTotalPurchase: this.totalPurchase,
            localPurchase: this.purchase
        };
    },
    mounted() {
        EventBus.$on("purchase-extracted", this.removeProductFromPurchase);
        EventBus.$on("total-updated-purchase", this.changeTotal);
        EventBus.$on("purchase-completed", purchase => {
            this.localPurchase.status = purchase.status;
        });
    },

    methods: {
        removeProductFromPurchase(index) {
            this.localProductsInPurchase.splice(index, 1);
        },
        changeTotal(newTotalPurchase) {
            this.localTotalPurchase = newTotalPurchase;
        },
        selectedInventory(inventory) {
            EventBus.$emit("selected-inventory", inventory.id);
        }
    },
    computed: {
        translateStatus() {
            if (this.localPurchase.status === "pending") return "Pendiente";
            return "Completado";
        }
    }
};
</script>
