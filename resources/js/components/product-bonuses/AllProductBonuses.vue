<template>
    <nav-component>
        <div
            class="grid grid-cols-1 md:grid-cols-4 2xl:grid-cols-5 gap-4"
        >
            <product-bonus-list></product-bonus-list>
        </div>
        <information-component>
            <template slot="title">
                Bonificacion de productos y categorías
            </template>

            <!-- <message
                :title="modalDataConfirm.title"
                :message="modalDataConfirm.message"
            ></message>
            <template slot="button">
                <agree
                    :method="modalDataConfirm.action"
                    @deleteProduct="deleteProduct"
                ></agree>
            </template> -->
        </information-component>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import ProductBonusList from "./ProductBonusList.vue";
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    components: {
        NavComponent,
        InformationComponent,
        ProductBonusList
    },
};
</script>
