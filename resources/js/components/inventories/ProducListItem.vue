<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{product.category_name}}</th>
        <td class="px-6 py-4">{{ product.sku }}</td>
        <td class="px-6 py-4">{{ product.description }}</td>
        <td class="px-6 py-4">
            <input-stock
                v-if="show"
                :product="product"
                :inventory="inventory"
                :index="index"
            ></input-stock>
            <div
                class="text-lg text-blue-700 hover:text-indigo-500 transition-all cursor-pointer"
                v-else
                @dblclick="show = true"
            >
                {{ product.stock }}
            </div>
        </td>
    </tr>
</template>
<script>
import InputStock from "./InputStock.vue";

export default {
    props: {
        product: {
            type: Object
        },
        inventory:{
            type:Object
        },
        index:{
            type:Number
        }
    },
    components: {
        InputStock
    },
    created() {
        EventBus.$on("updated-stock",data => {
            this.show = false;
        })
    },
    data() {
        return {
            show: false
        };
    }
};
</script>
