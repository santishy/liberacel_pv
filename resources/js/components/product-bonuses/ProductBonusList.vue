<template>
    <div class="relative overflow-x-auto bg-white">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class="text-xs text-slate-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Categoría/Producto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Puntos
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor de comisión
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Desactivar
                    </th>
                </tr>
            </thead>
            <tbody>
                <product-bonus-item v-for="(productBonus, index) in productBonuses" :key="productBonus.id"
                    :product-bonus="productBonus" :index="index">
                </product-bonus-item>
            </tbody>
        </table>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>
<script>
import InfiniteLoading from "vue-infinite-loading";
import ProductBonusItem from "./ProductBonusItem.vue"
export default {
    components: {
        InfiniteLoading,
        ProductBonusItem,
    },
    data() {
        return {
            page: 1,
            productBonuses: [],
        };
    },
    mounted() {
        EventBus.$on('bonus-created', productBonus => {
            this.productBonuses.unshift(productBonus);
            EventBus.$emit('open-modal', false);
        });
        EventBus.$on('removed-product-bonus', index => {
            this.productBonuses.splice(index, 1);
        });
    },
    methods: {
        infiniteHandler($state) {
            axios
                .get("/product-bonuses", {
                    params: {
                        page: this.page,
                    },
                })
                .then((res) => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.productBonuses.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err)
                });
        },
    },
};
</script>
