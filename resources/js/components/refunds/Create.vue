<template>
    <nav-component>
        <div class="flex flex-wrap mt-24 w-full px-4 justify-center space-y-4">
            <div class="bg-white rounded-sm w-full sm:w-4/12 px-4 py-4">
                <h3 class="w-full text-lg font-semibold mb-4 text-center">Buscar Venta</h3>
                <sales-finder></sales-finder>
            </div>
            <div v-if="sale" class="w-full bg-white rounded-sm mt-4">
                <sales-cart :sale="sale"></sales-cart>
            </div>
        </div>
    </nav-component>
</template>

<script>
import SalesCart from '../sales/SalesCart.vue';
import NavComponent from '../NavComponent.vue';
import SalesFinder from './SalesFinder.vue'
export default {
    components: { SalesCart, NavComponent, SalesFinder },
    data(){
        return {
            sale:null,
        }
    },
    created(){
        EventBus.$on('sale-to-refund',sale => {
            this.sale = sale;
        })
    }
}
</script>
