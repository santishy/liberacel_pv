<template>
    <tr>
        <td class="border px-4 py-2">{{ inventory.name }}</td>
        <td class="border px-4 py-2">{{ inventory.address }}</td>
        <td class="border px-4 py-2 flex flex-wrap justify-center">
            <link-edit-warehouse :inventory="inventory" class="mr-2"></link-edit-warehouse>
            <empty-warehouse
                :warehouse="inventory"
                :index="index"
                class="mr-2"
            ></empty-warehouse>
            <delete-warehouse :inventory="inventory" :index="index"></delete-warehouse>
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
