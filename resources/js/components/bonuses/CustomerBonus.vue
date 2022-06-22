<template>
    <div v-if="customerBonus" class="flex flex-wrap items-center px-2">
        <span class="font-mono text-xl font-light text-teal-700 mr-2">{{
            customerBonus.phone_number
        }}</span>

        <span class="rounded-sm px-2 bg-green-700 text-white font-semibold">
            Pts: {{ customerBonus.accumulated_points }}
        </span>

        <div class="text-sm px-2 ml-2">
            Dinero electroinco:
            <span class="text-base font-semibold text-blue-700">
                {{ electronicMoney }}</span
            >
        </div>
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
import {mapMutations, mapState} from "vuex";
export default {
    components: { UserCircleIcon },
    props: {
        inputStyle: {
            type: String,
            default: "",
        },
    },
    data() {
        return {
            form: {},
            customerBonus: null,
            electronicMoney: null,
        };
    },
    created() {
        if (this.currentFastSale?.id) {
            this.customerBonus = this.currentFastSale.customer_bonus;
            this.electronicMoney = this.currentFastSale.electronicMoney;
        }
    },

    methods: {
        ...mapMutations(['SET_CURRENT_FAST_SALE']),
        async submit() {
            try {
                this.form.fast_sale_id = this.currentFastSale.id;
                const res = await axios.post(
                    "/fast-sales-customer-bonuses",
                    this.form
                );
                if (res.data?.customer_bonus) {
                    this.customerBonus = res.data.customer_bonus;
                    this.electronicMoney = res.data.electronicMoney;
                    this.currentFastSale.customer_bonus = this.customerBonus;
                    this.currentFastSale.electronicMoney = this.electronicMoney;
                    this.SET_CURRENT_FAST_SALE(this.currentFastSale);
                }
            } catch (e) {
                console.log(e);
            }
        },
    },
    computed:{
        ...mapState(["currentFastSale"]),
    }
};
</script>
