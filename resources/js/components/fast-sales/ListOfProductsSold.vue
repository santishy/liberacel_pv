<template>
    <div
        v-if="params"
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
        <table
            class="
                w-full
                flex flex-row flex-no-wrap
                sm:bg-white
                rounded
                text-center
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
                    <th class="p-3 text-left sm:text-center">Nota</th>
                    <th class="p-3 text-left sm:text-center">Usuario</th>
                    <th class="p-3 text-left sm:text-center">Fecha</th>
                    <th class="p-3 text-left sm:text-center">Descripción</th>
                    <th class="p-3 text-left sm:text-center">Precio</th>
                    <th class="p-3 text-left sm:text-center">Cantidad</th>
                    <th class="p-3 text-left sm:text-center">Subtotal</th>
                    <th class="p-3 text-left sm:text-center">
                        Total Venta Completa
                    </th>
                    <th class="p-3 text-left sm:text-center" width="110px">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <product-sold
                    v-for="(product, index) in products"
                    :key="index"
                    :transaction="product"
                    :index="index"
                ></product-sold>
                <infinite-loading
                    @infinite="infiniteHandler"
                    :identifier="infiniteId"
                    ref="infiniteLoading"
                ></infinite-loading>
            </tbody>
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
            this.changeParams(data);
        });
    },
    methods: {
        infiniteHandler($state) {
            axios
                .get(this.uri, {
                    params: {
                        isFastSale: true,
                        page: this.page,
                        ..._.merge(this.params, this.getRelathionships),
                    },
                })
                .then((res) => {
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.data.length) {
                        this.page += 1;
                        let products = this.structureTheData(res.data.data);
                        console.log(products);
                        this.products.push(...products);
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
        structureTheData(data) {
            let newStructure = [];
            data.forEach((item) => {
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
    computed: {
        getRelathionships() {
            return { include: "user" };
        },
    },
};
</script>
