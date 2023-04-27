<template>
    <a :href="`/warehouses/${inventory.id}/edit`"
        class="text-xs flex justify-center items-center gap-1 transition-all rounded border-2 border-blue-800 text-blue-700 p-1 hover:bg-blue-800 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
        Editar
    </a>
</template>
<script>
import EditIcon from "../icons/EditIcon.vue";
export default {
    components: { EditIcon },
    props: {
        inventory: {
            type: Object
        }
    }
};
</script>
