<template>
    <button @click.prevent="destroy"
        class=" mt-2 rounded transition-all duration-500 ease-in-out hover:bg-red-200  text-red-700 font-semibold  py-1 px-2  hover:border-transparent mr-1">
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
        destroy(e) {
            if (e.keyCode == 13)
                return;
            console.log(e.keyCode)
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
