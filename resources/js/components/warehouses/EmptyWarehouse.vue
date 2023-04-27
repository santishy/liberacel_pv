<template>
    <form @submit.prevent="submit">
        <button type="submit"
            class="text-xs flex items-center gap-1 transition-all rounded border-2 border-orange-800 text-orange-700 p-1 hover:bg-orange-800 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
            </svg>
            Vaciar
        </button>
    </form>
</template>

<script>
import { mapMutations } from "vuex";
import WarehouseIcon from "../icons/WarehouseIcon.vue";
export default {
    components: { WarehouseIcon },
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
