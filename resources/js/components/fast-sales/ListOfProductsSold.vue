<template>
    <div v-if="params" class="table-container-responsive">
        <table class="report-table">
            <thead class="report-table-thead">
                <tr class="bg-green-200">
                    <th class="py-2 px-2">Nota</th>
                    <th class="py-2 px-2">Usuario</th>
                    <th class="py-2 px-2">Fecha</th>
                    <th class="py-2 px-2">Descripción</th>
                    <th class="py-2 px-2">Precio</th>
                    <th class="py-2 px-2">Cantidad</th>
                    <th class="py-2 px-2">Subtotal</th>
                    <th class="py-2 px-2">
                        Total Venta Completa
                    </th>
                    <th class="py-2 px-2 text-left sm:text-center" width="110px">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <product-sold v-for="(product, index) in structureTheData" :key="index" :transaction="product"
                    :index="index"></product-sold>
            </tbody>
            <infinite-loading v-if="!firstLoad.length" @infinite="infiniteHandler" :identifier="infiniteId"
                ref="infiniteLoading"></infinite-loading>
        </table>

        <authentication-form model="FastSale" :uri="`/fast-sales/${selectedFastSaleId}/associated-users`"
            :id="nota"></authentication-form>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";

import AuthenticationForm from "../auth/AuthenticationForm.vue";
import ProductSold from "./ProductSold.vue";
export default {
    props: {
        firstLoad: {
            type: Array,
            default: () => [],
        }
    },
    components: {
        InfiniteLoading,
        ProductSold,
        AuthenticationForm,
    },
    data() {
        return {
            products: [],
            page: 1,
            params: null,
            infiniteId: 1,
            uri: "/fast-sales",
            nota: null,
            selectedFastSaleId: null,
        };
    },
    mounted() {
        EventBus.$on("id-for-authentication-form", (id) => {
            this.selectedFastSaleId = id;
        });
        EventBus.$on("set-parameters", (data) => {
            this.changeParams(data);
        });
        EventBus.$on("associated-user", (id) => {
            EventBus.$emit("open-modal", false);
            let index = this.products.findIndex(element => {
                return element.id == id
            });
            if (index != -1) {
                this.products.splice(index, 1);
            }
        });
    },
    watch: {
        firstLoad: {
            handler(newValue, oldValue) {
                if (!Array.isArray(newValue)) {
                    throw new Error("It is not an array")
                }
                if (!newValue.length) {
                    return;
                }
                this.products = newValue;
                this.page = 2;
            },
            deep: true
        }
    },
    methods: {
        infiniteHandler($state) {
            console.log("infiniteHandler express page: ", this.page)
            axios
                .get(this.uri, {
                    params: {
                        isFastSale: true,
                        "filter[isCredit]": false, //me hace falta cambiar filtro aqui
                        page: this.page,
                        ..._.merge(this.params, this.getRelationships),
                    },
                })
                .then((res) => {
                    if (this.page == 1) {
                        EventBus.$emit("calculated-total", res.data.total);
                    }
                    if (res.data.data.length) {
                        this.page += 1;
                        this.products.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.products = [];
            this.infiniteId += 1;
        },
    },
    computed: {
        getRelationships() {
            return { include: "user" };
        },
        structureTheData() {
            let newStructure = [];
            this.products.forEach((item) => {
                let { products, created_at, total, status, id, user_name } =
                    item;
                newStructure.push(
                    ...products.map((product) => {
                        return {
                            created_at,
                            id,
                            status,
                            user_name,
                            total,
                            description: product.description,
                            qty: product.qty,
                            price: product.price,
                        };
                    })
                );
            });
            return newStructure;
        },
    },
};
</script>
