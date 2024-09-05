<template>
    <tr class="bg-white border-b text-slate-600">
        <th scope="row" class="px-6 py-4 font-medium text-slate-700 whitespace-nowrap">{{ inventory.name
            }}</th>
        <td class="px-6 py-4">{{ inventory.address }}</td>
        <td class="px-6 py-4">
            <div class="flex flex-col sm:flex-row justify-start gap-2">
                <link-edit-warehouse :inventory="inventory" class="mr-2"></link-edit-warehouse>
                <empty-warehouse :warehouse="inventory" :index="index" class="mr-2"></empty-warehouse>
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
        index: {
            type: Number
        }
    },
    components: {
        EmptyWarehouse,
        DeleteWarehouse,
        LinkEditWarehouse,
    }
};
</script>
