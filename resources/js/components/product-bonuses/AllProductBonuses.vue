<template>
    <layout-component>
        <div class="w-full sm:px-4">
            <div class="w-full flex justify-end mb-4">
                <button @click="openModal" class="
                        p-2
                        rounded
                        shadow-sm
                        hover:shadow-none
                        bg-purple-500
                        hover:bg-purple-700
                        flex
                        items-center
                        font-light
                        text-white
                    ">
                    Producto
                    <circle-add class="ml-3"></circle-add>
                </button>
            </div>
            <product-bonus-list></product-bonus-list>
        </div>
        <information-component>
            <template slot="title">
                Bonificacion de productos y categorías
            </template>
            <div>
                <bonus-form></bonus-form>
            </div>
        </information-component>
    </layout-component>
</template>

<script>
import ProductBonusList from "./ProductBonusList.vue";
import InformationComponent from "../modals/InformationComponent.vue";
import CircleAdd from "../icons/CircleAdd.vue";
import BonusForm from './BonusForm.vue';
export default {
    components: {
        CircleAdd,
        InformationComponent,
        ProductBonusList,
        BonusForm,
    },
    methods: {
        openModal() {
            EventBus.$emit('open-modal', true);
        }
    }
};
</script>
