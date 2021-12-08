<template>
    <div
        class="
            p-2
            border-l-4 border-teal-400
            flex flex-wrap
            items-baseline
            md:w-9/12
            mx-auto
            bg-white
            shadow-sm
            rounded
        "
    >
        <h3
            class="
                p-2
                border-b border-gray-300
                text-center
                w-full
                font-mono
                text-2xl
            "
        >
            Nota
        </h3>
        <table
            class="
                w-full
                flex flex-row flex-no-wrap
                sm:bg-white
                rounded-lg
                overflow-hidden
                my-5
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
                    <th class="p-3 text-left">Descripción</th>
                    <th class="p-3 text-left">Precio</th>
                    <th class="p-3 text-left">Cantidad</th>
                    <th class="p-3 text-left" width="110px">Actions</th>
                </tr>
            </thead>
            <tbody class="flex-1 sm:flex-none">
                <concept-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :product="product"
                    :index="index"
                    :sale="sale"
                ></concept-list-item>
            </tbody>
        </table>
    </div>
</template>

<script>
import ConceptListItem from "./ConceptListItem.vue";
export default {
    components: { ConceptListItem },
    props: {
        sale: {
            type: Object,
        },
    },
    data() {
        return {
            products: [],
            nota: null,
            status: null,
            total: null,
            currentDate:null,
        };
    },
    created() {
        EventBus.$on("fast-sale", (sale) => {
            //this.products.unshift(sale.product)
            this.fillData(sale);
        });
        if (this.sale) {
            //this.products = this.sale.concepts;
            this.fillData(this.sale);
        }
    },
    methods: {
        fillData(sale) {
            this.products =sale.products;
            this.nota = sale.id;
            this.status = sale.status;
            this.total = sale.total;
            this.currentDate = sale.created_at;
        },
    },
};
</script>
<style lang="css">
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
</style>
