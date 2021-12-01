<template>
    <form @submit.prevent="openModal">
        <button
            class="text-xs transition-all rounded border-2 border-red-800 text-red-700 p-1 hover:bg-red-800 hover:text-white"
            type="submit"
        >
            <trash-icon></trash-icon>
            Eliminar almacen
        </button>
    </form>
</template>
<script>
import { mapMutations } from "vuex";
import TrashIcon from '../icons/TrashIcon.vue';
export default {
    components:{TrashIcon},
    props: {
        inventory: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        openModal() {
            this.setModalDataConfirm({
                inventory: this.inventory,
                index: this.index,
                message:
                    "Si eliminas el almacén, no se podran revertir los cambios.",
                title: "¿Estas seguro de eliminar el almacén?",
                action: "deleteWarehouse",
                actionEnabled: true
            });
            EventBus.$emit("open-modal", true);
        }
    }
};
</script>
