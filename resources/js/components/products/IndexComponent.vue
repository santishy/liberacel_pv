<template>
    <layout-component>
        <div class="grid grid-cols-1 md:grid-cols-4 2xl:grid-cols-5 ">
            <div class="col-span-4 2xl:col-span-5 flex justify-end items-baseline rounded-t-sm p-4 bg-white">
                <search-by-category class="md:w-1/4 w-3/4 mr-2" :categories="categories"></search-by-category>
                <search-component ref="search" class="md:w-1/4 w-3/4 " />
            </div>
            <product-list class="col-span-5">
                <product-list-item v-for="(product, index) in products" :key="product.id" :product="product"
                    :index="index">
                </product-list-item>
            </product-list>
            <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler"></infinite-loading>
        </div>
        <information-component>
            <template slot="title">
                Productos
            </template>

            <message :title="modalDataConfirm.title" :message="modalDataConfirm.message"></message>
            <template slot="button">
                <agree :method="modalDataConfirm.action" @deleteProduct="deleteProduct"></agree>
            </template>
        </information-component>
    </layout-component>
</template>
<script>
import Agree from "../alerts/Agree.vue";
import Message from "../alerts/Message.vue";
//import NavComponent from "../NavComponent.vue";
import InfiniteLoading from "vue-infinite-loading";
import SearchComponent from "./SearchComponent.vue";
import SearchByCategory from "./SearchByCategory.vue";
import { mapActions, mapState, mapMutations } from "vuex";
import ProductCardComponent from "./ProductCardComponent.vue";
import ProductList from "./ProductList";
import ProductListItem from "./ProductListItem"
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
        this.getQueryType();
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
    //    NavComponent,
        InformationComponent,
        Agree,
        Message,
        SearchByCategory,
        ProductList,
        ProductListItem
    },
    methods: {
        ...mapActions(["getProducts", "search"]),
        ...mapMutations(["setModalDataConfirm", "SET_QUERY_TYPE"]),
        getQueryType() {
            let url = new URL(window.location.href);
            this.SET_QUERY_TYPE(url.searchParams.get('queryType'));
        },
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
                .catch(err => { });
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
