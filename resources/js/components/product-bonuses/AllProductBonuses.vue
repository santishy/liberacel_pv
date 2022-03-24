<template>
    <nav-component>
        <div class="w-full px-4">
            <div class="w-full flex justify-end">
                <button
                    @click="openModal"
                    class="
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
                    "
                >
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
            <bonus-form></bonus-form>
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
import CircleAdd from "../icons/CircleAdd.vue";
import BonusForm from './BonusForm.vue';
export default {
    components: {
        NavComponent,
        CircleAdd,
        InformationComponent,
        ProductBonusList,
        BonusForm,
    },
    methods:{
        openModal(){
            EventBus.$emit('open-modal',true);
        }
    }
};
</script>
