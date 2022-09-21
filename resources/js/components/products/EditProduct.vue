<template>
    <a
        :href="`/products/${product.id}/edit`"
        class="
            px-2
            py-2
            text-2xl
            font-bold
            text-gray-600
            bg-white
            rounded-full
            shadow-xs
            hover:text-gray-800
        "
        v-can="'edit product'"
    >
        <edit-icon></edit-icon>
    </a>
</template>

<script>
import EditIcon from "../icons/EditIcon.vue";
export default {
    props:{
        product:{
            type: Object,
            required: [true,'Product is required.']
        }
    },
    components:{
        EditIcon
    }
}
</script>