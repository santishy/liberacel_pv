<template>
    <a
        :href="`/warehouses/${inventory.id}/edit`"
        class="text-xs transition-all rounded border-2 border-blue-800 text-blue-700 p-1 hover:bg-blue-800 hover:text-white"
    >
        <edit-icon></edit-icon>
        Editar almacén
    </a>
</template>
<script>
import EditIcon from "../icons/EditIcon.vue";
export default {
    components: {EditIcon},
    props: {
        inventory: {
            type: Object
        }
    }
};
</script>
