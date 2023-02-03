<template>
    <nav-component>
        <div class="flex flex-wrap mt-24 w-full px-4 justify-center space-y-4">
            <div class="bg-white rounded-sm w-full sm:w-4/12 px-4 py-4">
                <h3 class="w-full text-lg font-semibold mb-4 text-center">
                    Buscar Venta
                </h3>
                <sales-finder></sales-finder>
            </div>
            <div v-if="sale" class="w-full bg-white rounded-sm mt-4">
                    <product-list>
                        <product-list-item-base
                            v-for="(product, index) in sale.products"
                            :key="product.id"
                            :product="product"
                            :index="index"
                        >
                            <template v-slot:product-qty>
                                <refund-quantity-product
                                    :product="product"
                                    :sale-id="sale.id"
                                ></refund-quantity-product>
                            </template>
                            <template v-slot:product-price>
                                {{ product.sale_price }}
                            </template>
                            <template v-slot:product-destroy></template>
                        </product-list-item-base>
                    </product-list>
                    <refund-form :sale="sale"></refund-form>
            </div>
        </div>
    </nav-component>
</template>

<script>
import ProductListItemBase from "../sales/ProductListItemBase.vue";
import RefundQuantityProduct from "./partials/RefundQuantityProduct.vue";
import RefundForm from "./partials/RefundForm.vue"
import ProductList from "../sales/ProductList.vue";
import NavComponent from "../NavComponent.vue";
import SalesFinder from "./SalesFinder.vue";
export default {
    components: {
        RefundQuantityProduct,
        ProductList,
        ProductListItemBase,
        NavComponent,
        SalesFinder,
        RefundForm
    },
    data() {
        return {
            sale: null,

        };
    },
    created() {
        EventBus.$on("sale-to-refund", (sale) => {
            this.sale = sale;
        });

    },
};
</script>
