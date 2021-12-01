<template>
    <button
        @click.prevent="destroy"
        class=" bg-red-300 mt-2 rounded transition-all duration-500 ease-in-out hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border-b-2 border-red-500 hover:border-transparent mr-1"
    >
        <trash-icon></trash-icon>
    </button>
</template>
<script>
import { mapMutations } from "vuex";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components: { TrashIcon },
    props: {
        id: {
            type: Number
        },
        index: {
            type: Number
        }
    },
    methods: {
        destroy() {
            axios
                .delete(`/sales/${this.id}/products`)
                .then(res => {
                    if (res.data) {
                        EventBus.$emit("product-removed", this.index);
                        this.removeTransactionProduct(this.id);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        ...mapMutations(["removeTransactionProduct"])
    }
};
</script>
