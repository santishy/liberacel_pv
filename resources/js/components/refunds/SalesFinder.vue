<template>
    <form>
        <div class="mt-4  ">
            <!-- <inventory-list></inventory-list> -->
            <label for="sale" class="block mb-2 font-medium">ID de venta</label>
            <input v-model="id" type="text" @keyup="searchById"
                class="bg-gray-300 border p-2 border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <div class="flex items-center">
            <errors-component :errors-found="errors" />
        </div>
    </form>
</template>
<script>
import InventoryList from '../inventories/InventoryList.vue';
export default {
    components:{ InventoryList },
    data() {
        return {
            uri: '/sale-with-products',
            id: null
        }
    },
    methods: {
        searchById() {
            EventBus.$emit('sale-to-refund',null);
            if(this.id === '' || !this.id){
                return;
            }
            axios.get(this.uri, {
                params:
                {
                    'filter[searchByIdAndCompletedStatus]' : this.id
                }
            })
                .then(res => {
                    EventBus.$emit('sale-to-refund',res.data.sale);
                })
                .catch( error => {
                    this.getErrors(error);
                })
        }
    }
}
</script>
