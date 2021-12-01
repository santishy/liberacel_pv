<template>
    <form @submit.prevent="submit">
        <button
            type="submit"
            class="transition-all text-xs rounded border-2 border-red-800 px-2 text-red-700 hover:bg-red-800 hover:text-white"
        >
            <ban-icon></ban-icon> Cancelar
        </button>
    </form>
</template>
<script>
import { mapMutations } from "vuex";
import BanIcon from '../icons/BanIcon.vue'
export default {
    components: {BanIcon},
    props: {
        uri: {
            type: String
        },
        index: {
            type: Number
        },
        transaction: { type: Object }
    },
    data() {
        return {
            translate: { purchase: "Compra", sale: "Venta" }
        };
    },
    methods: {
        ...mapMutations(["setModalDataConfirm"]),
        submit() {
            this.setModalDataConfirm({
                transaction: this.transaction,
                index: this.index,
                message: `Si cancelas esta ${
                    this.translate[this.transaction.transactionType]
                } los cambios hechos previamente en las existencias de el inventario asociado con esta misma, serán revertidos y ya no podras deshacer esta acción.`,
                title: `¿Estas seguro de eliminar esta ${
                    this.translate[this.transaction.transactionType]
                }?`,
                action: "cancelTransaction"
            });
            EventBus.$emit("open-modal", true);
        }
    }
};
</script>
