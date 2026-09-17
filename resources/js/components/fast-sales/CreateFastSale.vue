<template>
    <layout-component>
        <subtotals></subtotals>
        <div
            class="p-4 flex flex-wrap items-baseline w-full sm:w-9/12 mx-auto bg-white shadow-sm rounded"
        >
            <h3 class="w-full font-mono text-2xl">Crear venta</h3>
            <!-- <sale-to-customer v-show="showSaleToCustomer" uri="/clients/" class="w-full"></sale-to-customer>-->
            <!-- <sale-to-customer v-show="showSaleToCustomer" :uri="`/client/${currentFastSale?.id}/fast-sales`" /> -->
            <div
                v-if="hasCurrentFastSale"
                class="flex py-2 items-center justify-between w-full gap-4 flex-col sm:flex-row"
            >
                <raffle-phone-number
                    @assign-raffle-number="assignRaffleNumber"
                    v-if="hasActiveRaffle"
                />
                <div class="flex flex-col gap-2 items-center justify-center">
                    <sale-to-customer
                        :customer-phone="currentFastSale.customer_phone"
                        :uri="`/client/${currentFastSale?.id}/fast-sales`"
                    />
                    <credit-status
                        :url="`/fast-sales/${currentFastSale?.id}`"
                    />
                </div>
            </div>
            <fast-sale-form
                :product-bonuses="productBonuses"
                class="mt-4"
            ></fast-sale-form>
        </div>
        <concepts-list :sale="sale" class="mt-4"></concepts-list>
    </layout-component>
</template>

<script>
import { mapMutations, mapState } from "vuex";
import FastSaleForm from "./FastSaleForm.vue";
import ConceptsList from "./ConceptsList.vue";
import Subtotals from "./Subtotals.vue";
import SaleToCustomer from "../credits/clients/SaleToCustomer.vue";
import CreditStatus from "../credits/CreditStatus.vue";
import RafflePhoneNumber from "../raffle-numbers/RafflePhoneNumber.vue";
export default {
    components: {
        FastSaleForm,
        ConceptsList,
        Subtotals,
        SaleToCustomer,
        CreditStatus,
        RafflePhoneNumber,
    },
    props: {
        sale: {
            type: Object,
            default: null,
        },
        hasActiveRaffle: {
            type: Boolean,
            default: false,
        },
        productBonuses: { type: Array },
    },

    mounted() {},
    created() {
        this.setActiveRaffle(this.hasActiveRaffle);
        this.SET_CURRENT_FAST_SALE(this.sale);

        /* EventBus.$on('associated-user',(id)=>{
            this.SET_CURRENT_FAST_SALE({});
        }) */
        /**
         * Listens for the 'credit-status-change' event and updates the 'showSaleToCustomer' property accordingly.
         *
         * @param {string} status - The new credit status.
         */
        /*  EventBus.$on('credit-status-change', (status) => {
             this.showSaleToCustomer = status;
         }) */
    },
    methods: {
        ...mapMutations(["SET_CURRENT_FAST_SALE"]),
        ...mapMutations("raffles", ["setActiveRaffle"]),
        async assignRaffleNumber(customerPhone) {
            try {
                const { data } = await axios.patch(
                    `/fast-sales/${this.currentFastSale?.id}/customer-phone`,
                    {
                        customer_phone: customerPhone,
                    }
                );
                this.SET_CURRENT_FAST_SALE({
                    ...this.currentFastSale,
                    customer_phone: data.customer_phone,
                });
            } catch (error) {
                console.error("Error assigning raffle number:", error);
            }
        },
    },
    computed: {
        ...mapState(["currentFastSale"]),
        hasCurrentFastSale() {
            const sale = this.currentFastSale;
            return !!sale?.id;
        },
    },
};
</script>
