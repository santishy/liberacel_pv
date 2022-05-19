<template>
    <form @submit.prevent="submit">
        <div>
            <input
                type="text"
                v-model="form.phone_number"
                :class="inputStyle"
                placeholder="Ejemplo: 3531002244"
            />
        </div>
        <slot name="bonus-button"> </slot>
    </form>
</template>
<script>
export default {
    props: {
        inputStyle: {
            type: String,
            default: "",
        },
        fastSale: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: {},
        };
    },
    mounted() {
        this.form.fast_sale_id = this.fastSale.id;
        console.log(this.fastSale);
    },
    methods: {
        async submit() {
            try {
                const res = await axios.post("/customer-bonuses", this.form);
                console.log(res);
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>
