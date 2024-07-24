<template>
    <layout-component>
        <div class="w-10/12 mx-auto  flex" v-can="'view warehouses'">
            <div class="w-1/5 px-2 space-y-2">
                <div>
                    <input type="radio" value="STOCK" v-model="selectedOption" id="stock" name="filter" class="hidden peer">
                    <label for="stock"
                        class="flex items-center justify-around w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                        <div class="block">
                            <div class="w-full text-sm leading-tight">PRODUCTOS EN EXISTENCIA</div>
                        </div>
                        <svg fill="none" class="w-10 h-10" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z">
                            </path>
                        </svg>
                    </label>
                </div>
                <div>
                    <input type="radio" :checked="true" value="COSTS" id="costs" v-model="selectedOption" name="filter"
                        class="hidden peer">
                    <label for="costs"
                        class="flex items-center justify-around w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                        <div class="block">
                            <div class="w-full text-sm leading-tight">COSTOS DE PRODUCTOS</div>
                        </div>
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3">
                            </path>
                        </svg>
                    </label>
                </div>
                <inventory-list></inventory-list>
            </div>
            <div class="w-4/5">
                <product-list v-if="selectedOption.toUpperCase() === 'STOCK'" />
                <inventory-costs-by-warehouse v-if="selectedOption.toUpperCase() === 'COSTS'" />
            </div>
        </div>
    </layout-component>
</template>

<script>
import ProductList from "./ProductList";
//import NavComponent from "../NavComponent.vue";
import InventoryList from "./InventoryList.vue";
import InventoryCostsByWarehouse from "./InventoryCostsByWarehouse.vue";
export default {
    components: {
        ProductList,
        InventoryList,
       // NavComponent,
        InventoryCostsByWarehouse,
    },
    data() {
        return {
            selectedOption: ""
        }
    },
    props: {
        InventoryListinventories: {
            type: Array
        }
    },
    methods: {
        handleOptions() {
            console.log(this.selectedOption);
        }
    }
};
</script>
