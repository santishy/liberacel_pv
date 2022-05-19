<template>
    <nav-component>
        <div
            class="
                p-2
                border-l-4 border-blue-500
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
                Crear venta
            </h3>
            <fast-sale-form
                :product-bonuses="productBonuses"
                class="mt-4"
            ></fast-sale-form>
        </div>
        <concepts-list :sale="sale" class="mt-4"></concepts-list>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import FastSaleForm from "./FastSaleForm.vue";
import ConceptsList from "./ConceptsList.vue";

export default {
    components: {
        NavComponent,
        FastSaleForm,
        ConceptsList,
    },
    props: {
        sale: {
            type: Object,
            default: null
        },

        productBonuses: { type: Array },
    },
};
</script>
