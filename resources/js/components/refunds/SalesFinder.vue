<template>
    <form>
        <div class="mt-4  ">
            <inventory-list></inventory-list>
            <label for="sale" class="block mb-2 font-medium">ID de venta</label>
            <input v-model="id" type="text" @keyup="searchById"
                class="bg-gray-300 border p-2 border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
            if(this.id === '' || !this.id){
                return;
            }
            axios.get(this.uri, {
                params:
                {
                    'filter[searchById]' : this.id
                }
            })
                .then(res => {
                    console.log(res.data)
                    EventBus.$emit('sale-to-refund',res.data.sale);
                })
        }
    }
}
</script>
