<template>
    <nav-component>
        <div class="grid  grid-cols-1 md:grid-cols-4 2xl:grid-cols-5 gap-4 ">
            <div class="col-span-4 2xl:col-span-5 flex justify-center items-baseline">
                
                <search-by-category
                    class="md:w-1/4 w-3/4 mr-2"
                    :categories="categories"
                ></search-by-category>
                <search-component ref="search" class="md:w-1/4 w-3/4 " />
            </div>
            <product-card
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :index="index"
                transaction-type="purchase"
                class="col-span-3 md:col-span-1"
            />
            <infinite-loading
                :identifier="infiniteId"
                @infinite="infiniteHandler"
            ></infinite-loading>
        </div>
        <information-component>
            <template slot="title">
                Productos
            </template>

            <message
                :title="modalDataConfirm.title"
                :message="modalDataConfirm.message"
            ></message>
            <template slot="button">
                <agree
                    :method="modalDataConfirm.action"
                    @deleteProduct="deleteProduct"
                ></agree>
            </template>
        </information-component>
    </nav-component>
</template>
<script>
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
import NavComponent from "../NavComponent.vue";
import InfiniteLoading from "vue-infinite-loading";
import SearchComponent from "./SearchComponent.vue";
import SearchByCategory from "./SearchByCategory.vue";
import { mapActions, mapState, mapMutations } from "vuex";
import ProductCardComponent from "./ProductCardComponent.vue";
import InformationComponent from "../modals/InformationComponent.vue";

export default {
    props: {
        categories: {
            type: Array
        }
    },
    data() {
        return {
            products: [],
            page: 1,
            wantedProduct: null,
            params: { page: 1 },
            infiniteId: 1,
            obj: new Object(),
            arr: new Array(),
            message: null
        };
    },
    created() {
        this.cleanLocalStorage();
    },
    mounted() {
        this.cleanLocalStorage();
        EventBus.$on("matching-products", this.matchingProducts);
        EventBus.$on("empty-search", this.reloadIndex);
        EventBus.$on("failed-deletion", message => {
            this.message = message;
        });
    },
    components: {
        "product-card": ProductCardComponent,
        InfiniteLoading,
        "search-component": SearchComponent,
        NavComponent,
        InformationComponent,
        Agree,
        Message,
        SearchByCategory
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        ...mapMutations(["setModalDataConfirm"]),
        removeFromArray(index) {
            this.products.splice(index, 1);
        },
        infiniteHandler($state) {
            this.search(this.params)
                .then(res => {
                    if (res.data.data.length) {
                        this.params.page += 1;
                        this.products.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch(err => {});
        },
        matchingProducts(data) {
            this.products = data.products;
            this.params = data.params;
            this.infiniteId++;
        },
        reloadIndex() {
            console.log("entro");
            this.infiniteId++;
            this.params = { page: 1 };
            this.products = [];
        },
        cleanLocalStorage() {
            if (
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == "" ||
                document.head.querySelector('meta[name="purchase_id"]')
                    .content == null
            )
                localStorage.removeItem("productsInPurchase");
        },
        deleteProduct() {
            EventBus.$emit("open-modal", false);
            axios
                .delete(`/products/${this.modalDataConfirm.product.id}`)
                .then(res => {
                    if (res.data) {
                        if (res.data.deleted) {
                            this.removeFromArray(this.modalDataConfirm.index);
                            this.setModalDataConfirm({});
                            return;
                        }
                        this.setModalDataConfirm({
                            message: res.data.message,
                            title: "No se pudo eliminar"
                        });
                        EventBus.$emit("open-modal", true);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        ...mapState(["modalDataConfirm"])
    }
};
</script>
