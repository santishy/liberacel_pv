<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-20">
        <div @click="isOpen = false" class="fixed inset-0 z-10"></div>
        <div
            class="w-full md:w-10/12 shadow z-20 h-screen overflow-y-scroll overflow-x-hidden bg-white py-6 px-6"
        >
            <div class="flex justify-end">
                <button
                    @click="isOpen = false"
                    class="mt-2 mb-2 text-2xl p-0 m-0"
                >
                    <i class="far fa-window-close"></i>
                </button>
            </div>
            <div class="grid md:grid-cols-3 grid-cols-1 gap-4 ">
                <product-list
                    class="col-span-5"
                >
                    <product-list-item
                        v-for="(product, index) in products"
                        :key="product.id"
                        :product="product"
                        :index="index"
                    >
                    </product-list-item>
                </product-list>
                <!-- <product-card
                    v-for="(product, index) in products"
                    :key="product.id"
                    :product="product"
                    :search-in-sales="true"
                    :index="index"
                >
                </product-card> -->
            </div>
            <infinite-loading @infinite="getProducts"></infinite-loading>
        </div>
    </div>
</template>
<script>
import { mapActions } from "vuex";
import ProductCardComponent from "./ProductCardComponent";
import ProductList from "./ProductList";
import ProductListItem from "./ProductListItem";
export default {
    data() {
        return {
            products: [],
            isOpen: false,
            sku:'',
            params:{},
        };
    },
    created() {
        EventBus.$on("matching-products", obj => {
            this.products = obj.products;
            this.params = obj.params;
            this.isOpen = true;
        });
    },
    components: {
        "product-card": ProductCardComponent,
        ProductList,
        ProductListItem
    },
    methods: {
        ...mapActions(["search"]),
        async getProducts($state) {
            try {

                const { data } = await this.search(this.params);
                if (data.data.length) {
                    this.params.page += 1;
                    this.products.push(...data.data);
                    $state.loaded();
                }
                else{
                    $state.complete();
                }
            } catch (error) {}
        }
    }
};
</script>
