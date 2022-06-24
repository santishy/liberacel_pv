<template>
    <form @submit.prevent="submit">
        <button
            class="
                rounded-sm
                shadow-sm
                bg-blue-600
                hover:shadow-none hover:bg-blue-700
                text-white
                font-semibold
                px-2 py-1
            "
        >
            Aplicar Descuento
        </button>
    </form>
</template>

<script>
import axios from "axios";
import { mapState } from "vuex";
export default {
    methods: {
        async submit() {
            try {
                const res = axios.post(
                    `/fast-sales/${this.currentFastSale.id}/customer-bonuses`,
                    {'_method':'PUT'}
                );
                console.log(res);
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
