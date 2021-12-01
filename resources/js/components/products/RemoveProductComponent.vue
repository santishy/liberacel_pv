<template>
    <button
        @click="openAlert"
        v-can="'delete product'"
        class="text-red-500 hover:text-red-700 shadow-xs border-b-2 border-t-2 border-red-500 font-bold py-2  hover:border-red-700 rounded"
    >
        <trash-icon></trash-icon>
    </button>
</template>
<script>
import { mapMutations } from "vuex";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components:{TrashIcon},
    props: {
        product: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        openAlert() {
            this.setModalDataConfirm({
                product: this.product,
                index: this.index,
                message:
                    "Si eliminas este producto, no se podran revertir los cambios en la base de datos.",
                title: "¿Estas seguro de eliminar el producto?",
                action: "deleteProduct"
            });
            EventBus.$emit("open-modal", true);
        }
    }
};
</script>
