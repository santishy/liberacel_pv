<template>
    <div v-can="'create sale'" class="mt-4 bg-white w-4/5 shaddow rounded-sm border py-4 px-4">
        <template v-if="isAdmin">
            <p class="text-center text-2xl mb-4">Elige un almacén</p>
            <inventory-list class="mb-4"></inventory-list>
        </template>
        
        <p class="text-center text-2xl">Precio de venta</p>
        <div class="flex justify-center mt-2 mb-2">
            <button
                @click="changeSaleOption('retail_price')"
                class="bg-blue-500 rounded transition-all duration-500 ease-in-out hover:bg-blue-700 text-blue-900 font-semibold hover:text-white py-4 px-6 border-2 border-r-2 border-blue-700 hover:border-transparent w-full mr-2"
            >
                Al por menor
            </button>
            <button
                @click="changeSaleOption('wholesale_price')"
                class="bg-yellow-500 rounded transition-all duration-500 ease-in-out hover:bg-yellow-900 text-yellow-900 font-semibold hover:text-white py-4 px-6 border-2  border-yellow-900 hover:border-transparent w-full"
            >
                Al por mayor
            </button>
        </div>
    </div>
</template>

<script>
import { mapMutations } from "vuex";
import InventoryList from "../inventories/InventoryList.vue";

export default {
    components: {
        InventoryList
    },
    methods: {
        changeSaleOption(value) {
            this.setSalePriceOption(value);
            sessionStorage.setItem("salePriceOption", value);
        },
        ...mapMutations(["setSalePriceOption"])
    }
};
</script>
