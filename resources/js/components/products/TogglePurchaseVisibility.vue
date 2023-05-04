<template>
    <div v-if="method.toUpperCase() == 'POST' " class="flex flex-col justify-center rounded  p-2 ">
        <div class="flex flex-wrap justify-center mb-2">
            <p class="text-xs font-bold ">Compras:</p>
            <span
                :class="[getTextColor]"
                class="font-semibold text-xs ml-2 font-mono"
            >
                {{ getTitle }}
            </span>
        </div>
        <div class="flex flex-wrap mt-0 justify-center">
            <button
                @click.prevent="togglePurchaseVisibility(true)"
                class="mr-2 text-green-700 hover:bg-blue-700 hover:text-white p-2 rounded"
            >
                <div class="flex flex-wrap">
                    <check-circle></check-circle>
                    <span class="text-xs ml-1">Activar</span>
                </div>
            </button>
            <button
                @click.prevent="togglePurchaseVisibility(false)"
                class="text-orange-700 hover:bg-yellow-600 hover:text-white p-2 rounded"
            >
                <div class="flex flex-wrap">
                    <times-circle />
                    <span class="text-xs ml-1"> Desactivar </span>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
import CheckCircle from "../icons/CheckCircle.vue";
import TimesCircle from "../icons/TimesCircle.vue";
import {mapMutations,mapState} from "vuex"
export default {
    components: {
        CheckCircle,
        TimesCircle
    },
    props: {
        visibility: {
            type: Boolean
        },
        method:{
            type:String
        }
    },
    methods: {
        ...mapMutations(["SET_PURCHASE_VISIBILITY"]),
        togglePurchaseVisibility(bool) {
            this.SET_PURCHASE_VISIBILITY(bool);
        }
    },
    computed: {
        ...mapState(["purchaseVisibility"]),
        getTitle() {
            return this.purchaseVisibility ? "Activa" : "Desactivada";
        },
        getTextColor() {
            return this.purchaseVisibility ? "text-green-700" : "text-red-700";
        }
    }
};
</script>
