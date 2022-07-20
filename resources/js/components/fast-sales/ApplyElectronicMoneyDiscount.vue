<template>
    <form @submit.prevent="submit">
        <button
            class="
                bg-transparent
                hover:bg-blue-500
                text-blue-700
                font-semibold
                hover:text-white
                py-2
                px-4
                border border-blue-500
                hover:border-transparent
                rounded
            "
        >
            Aplicar Descuento
        </button>
    </form>
</template>

<script>
import axios from "axios";
import { mapState, mapMutations } from "vuex";
export default {
    ...mapMutations(["SET_CURRENT_FAST_SALE"]),
    methods: {
        async submit() {
            try {
                const res = await axios.post(
                    `/fast-sales/${this.currentFastSale.id}/customer-bonuses`,
                    { _method: "PUT" }
                );
                if(res.data?.fastSale){
                    this.SET_CURRENT_FAST_SALE(res.data.fastSale);
                }
            } catch (error) {
                console.error(error);
            }
        },
    },
    computed: {
        ...mapState(["currentFastSale"]),
    },
};
</script>
