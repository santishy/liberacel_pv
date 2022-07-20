<template>
    <div>
        <table
            class="
                min-w-full
                border-collapse
                block
                md:table
                shadow-sm
                text-center
                rounded-lg
            "
        >
            <thead class="block md:table-header-group">
                <tr
                    class="
                        border-b border-gray-500
                        rounded-t-sm
                        md:border-none
                        block
                        md:table-row
                        absolute
                        -top-full
                        md:top-auto
                        -left-full
                        md:left-auto md:relative
                    "
                >
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Categoría/Producto
                    </th>
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Puntos
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                <product-bonus-item
                    v-for="productBonus in productBonuses"
                    :key="productBonus.id"
                    :product-bonus="productBonus"
                ></product-bonus-item>
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
    mounted(){
        EventBus.$on('bonus-created',productBonus => {
            this.productBonuses.unshift(productBonus);
            EventBus.$emit('open-modal',false);
        })
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
                    console.log(res)
                    if (res.data.data.length) {
                        this.page += 1;
                        this.productBonuses.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    this.getErrors(err);
                });
        },
    },
};
</script>
