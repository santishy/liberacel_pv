<template>
    <nav-component>
        <div  class="w-10/12 mx-auto mt-24 md:mt-32 flex" v-can="'view warehouses'">
            <div class="w-1/5 px-2">
                <inventory-list></inventory-list>
            </div>
            <div class="w-4/5">
                <product-list></product-list>
            </div>
        </div>
    </nav-component>
</template>

<script>
import InventoryList from "./InventoryList.vue";
import ProductList from "./ProductList";
import NavComponent from "../NavComponent.vue";
export default {
    components: { ProductList, InventoryList, NavComponent },
    props: {
        InventoryListinventories: {
            type: Array
        }
    }
};
</script>
