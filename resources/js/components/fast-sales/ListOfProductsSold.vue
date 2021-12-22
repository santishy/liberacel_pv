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
                    <th class="p-3 text-left sm:text-center">Nota</th>
                    <th class="p-3 text-left sm:text-center">Descripción</th>
                    <th class="p-3 text-left sm:text-center">Precio</th>
                    <th class="p-3 text-left sm:text-center">Cantidad</th>
                    <th class="p-3 text-left sm:text-center">Usuario</th>
                    <th class="p-3 text-left sm:text-center">Fecha</th>
                    <th class="p-3 text-left sm:text-center" width="110px">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <product-sold
                    v-for="(product, index) in products"
                    :key="product.id"
                    :product="product"
                    :index="index"
                    :id="id"
                ></product-sold>
            </tbody>
        </table>
        <infinite-loading
            @infinite="infiniteHandler"
            :identifier="infiniteId"
            ref="infiniteLoading"
        ></infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
    components: { InfiniteLoading },
    data() {
        return {
            products: [],
            page: 1,
            params: null,
            infiniteId: 1,
            uri:'/fast-sales'
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
                        page: this.page,
                        ..._.merge(this.params, this.getRelathionships),
                        ...this.searchTheWarehouses,
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
    },
    computed: {
        getRelathionships() {
            return { include: "user" };
        },
    },
};
</script>
