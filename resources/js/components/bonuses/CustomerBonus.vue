<template>
    <div v-if="customerBonus" class="flex flex-wrap items-center px-2">
        <span class="font-mono text-xl font-light text-teal-700 mr-2">{{
            customerBonus.phone_number
        }}</span>

        <span class="rounded-sm px-2 bg-green-700 text-white font-semibold">
            Pts: {{ customerBonus.accumulated_points }}
        </span>
    </div>
    <form v-else @submit.prevent="submit">
        <div v-if="customerBonus" class="flex flex-wrap">
            <span class="font-mono text-xl font-light text-teal-700 mr-2">{{
                customerBonus.phone_number
            }}</span>

            <span class="rounded-sm px-2 bg-green-700 text-white font-semibold">
                Pts: {{ customerBonus.accumulated_points }}
            </span>
        </div>
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
import UserCircleIcon from "../icons/UserCircleIcon.vue";
export default {
    components: { UserCircleIcon },
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
            customerBonus: null,
        };
    },
    mounted() {
        if (this.fastSale?.id) {
            this.form.fast_sale_id = this.fastSale.id;
            this.customerBonus = this.fastSale.customer_bonus;
        }
    },
    watch: {
        fastSale: function (val) {
            if (this.fastSale.status != "pending") this.customerBonus = null;
            this.form.fast_sale_id = val.id;
            if (val?.customer_bonus) {
                this.customerBonus = val.customer_bonus;
            }
        },
    },
    methods: {
        async submit() {
            try {
                const res = await axios.post(
                    "/fast-sales-customer-bonuses",
                    this.form
                );

                if (res.data?.customer) {
                    this.customerBonus = res.data.customer;
                }
            } catch (e) {
                console.log(e);
            }
        },
    },
};
</script>
