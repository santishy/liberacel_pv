<template>
    <form @submit.prevent="submit">
        <button
            class="
                text-red-500
                hover:text-red-700
                shadow-xs
                font-bold
                py-2
                hover:border-red-700
                rounded
            "
        >
            <trash-icon></trash-icon>
        </button>
    </form>
</template>
<script>
import axios from "axios";
import TrashIcon from "../icons/TrashIcon.vue";

export default {
    components: {
        TrashIcon,
    },
    props: {
        productBonus: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
            required: true,
        },
    },
    methods: {
        submit() {
            axios
                .delete(`/product-bonuses/${this.productBonus.id}`)
                .then((res) => {
                    console.log(res)
                    if (res.data.removedProductBonus) {
                        EventBus.$emit("removed-product-bonus", this.index);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
