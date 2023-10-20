<template>
    <nav-component>
        <div class="flex flex-wrap items-center justify-between p-4">
            <search-by-phone-number />
            <status-filter />
        </div>
        <credit-list />
        <information-component v-show="Object.keys(credit).length">
            <template slot="title">
                Pago a credito
            </template>
            <payment-form v-if="Object.keys(credit).length" :credit="credit" />
        </information-component>
    </nav-component>
</template>
<script>
import CreditList from './CreditList.vue';
import StatusFilter from './StatusFilter.vue'
import NavComponent from '../NavComponent.vue';
import PaymentForm from '../payments/PaymentForm.vue';
import InformationComponent from '../modals/InformationComponent.vue';
import SearchByPhoneNumber from './clients/SearchByPhoneNumber.vue';
export default {
    data() {
        return {
            credit: {}
        }
    },
    components: {
        NavComponent,
        CreditList,
        InformationComponent,
        PaymentForm,
        SearchByPhoneNumber,
        StatusFilter
    },
    created() {
        EventBus.$on('open-payment-modal', this.openModalCredit)
    },
    methods: {
        openModalCredit(credit) {
            Vue.set(this.$data, 'credit', credit);
            //this.credit = credit;
            EventBus.$emit("open-modal", true);
        }
    }
}
</script>
