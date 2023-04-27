<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ inventory.name }}</th>
        <td class="px-6 py-4">{{ inventory.address }}</td>
        <td class="px-6 py-4">
            <div class="flex justify-start gap-2">
                <link-edit-warehouse :inventory="inventory" class="mr-2"></link-edit-warehouse>
                <empty-warehouse
                    :warehouse="inventory"
                    :index="index"
                    class="mr-2"
                ></empty-warehouse>
                <delete-warehouse :inventory="inventory" :index="index"></delete-warehouse>
            </div>
        </td>
    </tr>
</template>
<script>
import DeleteWarehouse from "./DeleteWarehouse.vue";
import EmptyWarehouse from "./EmptyWarehouse.vue";
import LinkEditWarehouse from "./LinkEditWarehouse.vue";
export default {
    props: {
        inventory: {
            type: Object
        },
        index:{
            type:Number
        }
    },
    components: {
        EmptyWarehouse,
        DeleteWarehouse,
        LinkEditWarehouse,
    }
};
</script>
