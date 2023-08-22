<template>
    <nav-component>
        <subtotals></subtotals>
        <div class="
                p-4

                flex flex-wrap
                items-baseline
                md:w-9/12
                mx-auto
                bg-white
                shadow-sm
                rounded
            ">
            <h3 class="
                    w-full
                    font-mono
                    text-2xl
                ">
                Crear venta
            </h3>
            <sale-to-customer uri="/clients/" class="w-full"></sale-to-customer>
            <fast-sale-form :product-bonuses="productBonuses" class="mt-4"></fast-sale-form>
        </div>
        <concepts-list :sale="sale" class="mt-4"></concepts-list>
    </nav-component>
</template>
<script>
import { mapMutations } from "vuex"
import NavComponent from "../NavComponent.vue";
import FastSaleForm from "./FastSaleForm.vue";
import ConceptsList from "./ConceptsList.vue";
import Subtotals from "./Subtotals.vue";
import SaleToCustomer from "../credits/clients/SaleToCustomer.vue";
export default {
    components: {
        NavComponent,
        FastSaleForm,
        ConceptsList,
        Subtotals,
        SaleToCustomer,
    },
    props: {
        sale: {
            type: Object,
            default: null
        },
        productBonuses: { type: Array },
    },
    created() {
        this.SET_CURRENT_FAST_SALE(this.sale);
        /* EventBus.$on('associated-user',(id)=>{
            this.SET_CURRENT_FAST_SALE({});
        }) */
    },
    methods: {
        ...mapMutations(["SET_CURRENT_FAST_SALE"])
    }
};
</script>
