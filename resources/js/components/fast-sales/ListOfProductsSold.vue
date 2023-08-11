<template>
    <div v-if="params"
        class="overflow-x-auto relative max-h-80 overflow-y-auto max-w-6xl mx-auto rounded shadow-lg bg-white">
        <table class="
                w-full table-auto text-sm text-center text-gray-500
            ">
            <thead class="text-xs font-mono border-b-2 border-gray-100 text-gray-700 uppercase ">
                <tr>
                    <th class="py-1 px-2">Nota</th>
                    <th class="py-1 px-2">Usuario</th>
                    <th class="py-1 px-2">Fecha</th>
                    <th class="py-1 px-2">Descripción</th>
                    <th class="py-1 px-2">Precio</th>
                    <th class="py-1 px-2">Cantidad</th>
                    <th class="py-1 px-2">Subtotal</th>
                    <th class="py-1 px-2">
                        Total Venta Completa
                    </th>
                    <th class="py-1 px-2 text-left sm:text-center" width="110px">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <product-sold v-for="(product, index) in structureTheData" :key="index" :transaction="product"
                    :index="index"></product-sold>
            </tbody>
            <infinite-loading @infinite="infiniteHandler" :identifier="infiniteId" ref="infiniteLoading"></infinite-loading>
        </table>

        <authentication-form model="FastSale" :id="nota"></authentication-form>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";

import AuthenticationForm from "../auth/AuthenticationForm.vue";
import ProductSold from "./ProductSold.vue";
export default {
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
        };
    },
    mounted() {
        EventBus.$on("set-parameters", (data) => {
            console.log({ "aqui": data })
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
    methods: {
        infiniteHandler($state) {
            console.log("Entro al infinite handler")
            axios
                .get(this.uri, {
                    params: {
                        isFastSale: true,
                        page: this.page,
                        ..._.merge(this.params, this.getRelationships),
                    },
                })
                .then((res) => {
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
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
