<template>
    <nav-component>
        <create-inventory
            :inventory="inventory"
            method="put"
            :uri="`/warehouses/${inventory.id}`"
        ></create-inventory>
    </nav-component>
</template>
<script>
import CreateInventory from "../inventories/CreateInventory.vue";
import NavComponent from "../NavComponent.vue";
export default {
    props: {
        inventory: {
            type: Object
        }
    },
    components: {
        CreateInventory,
        NavComponent
    }
};
</script>
