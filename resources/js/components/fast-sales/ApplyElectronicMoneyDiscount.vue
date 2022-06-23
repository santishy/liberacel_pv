<template>
    <form @submit.prevent="submit">
        <button>Aplicar Descuento</button>
    </form>
</template>

<script>
import axios from 'axios';
import { mapState } from 'vuex'
export default
    {
        methods: {
            async submit() {
                try {
                    const res = axios.post(
                        `fast-sales/${this.currentFastSale.id}/customer-bonuses`
                    );
                    console.log(res)
                } catch (error) {
                    console.error(error);
                }
            }
        },
        computed: {
            ...mapState(["currentFastSale"]),
        }
    }
</script>
