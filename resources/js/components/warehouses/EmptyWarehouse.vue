<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="text-xs transition-all rounded border-2 border-orange-800 text-orange-700 p-1 hover:bg-orange-800 hover:text-white"
        >
            <warehouse-icon></warehouse-icon>
            Vaciar almacén
        </button>
    </form>
</template>

<script>
import { mapMutations } from "vuex";
import WarehouseIcon from "../icons/WarehouseIcon.vue";
export default {
    components:{WarehouseIcon},
    props: {
        warehouse: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        submit() {
            this.setModalDataConfirm({
                inventory: this.warehouse,
                index: this.index,
                message:
                    "Si vacias las existencias de este almacén, no se podran revertir los cambios.",
                title:
                    "¿Estas seguro de eliminar las existencias de este almacén?",
                action: "emptyWarehouse",
                actionEnabled: true
            });
            EventBus.$emit("open-modal", true);
        }
    }
};
</script>
