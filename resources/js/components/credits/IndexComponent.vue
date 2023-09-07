<template>
    <nav-component>
        <credit-list />
        <information-component v-if="credit">
            <template slot="title">
                Pago a credito
            </template>
            <payment-form :credit="credit" />
        </information-component>
    </nav-component>
</template>
<script>
import CreditList from './CreditList.vue';
import NavComponent from '../NavComponent.vue';
import PaymentForm from '../payments/PaymentForm.vue';
import InformationComponent from '../modals/InformationComponent.vue';
export default {
    data() {
        return {
            credit: null
        }
    },
    components: {
        NavComponent,
        CreditList,
        InformationComponent,
        PaymentForm,
    },
    mounted() {
        EventBus.$on('open-payment-modal', this.openModalCredit)
    },
    methods: {
        openModalCredit(credit) {
            this.credit = credit;
            EventBus.$emit('open-modal', true);
        }
    }
}
</script>
