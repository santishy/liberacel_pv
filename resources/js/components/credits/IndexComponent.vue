<template>
    <nav-component>
        <div class="flex flex-wrap items-center justify-between p-4">
            <search-by-phone-number />
            <status-filter />
        </div>
        <credit-list />
        <information-component v-show="Object.keys(credit).length">
            <template slot="title">
                {{ title }}
            </template>
            <component :is="selectedComponent" v-if="Object.keys(credit).length" :credit="credit" />
            <!-- <payment-form v-if="Object.keys(credit).length" :credit="credit" /> -->
        </information-component>
    </nav-component>
</template>
<script>
import CreditList from './CreditList.vue';
import StatusFilter from './StatusFilter.vue'
import NavComponent from '../NavComponent.vue';
import CreditPayments from './payments/CreditPayments.vue';
import PaymentForm from '../payments/PaymentForm.vue';
import InformationComponent from '../modals/InformationComponent.vue';
import SearchByPhoneNumber from './clients/SearchByPhoneNumber.vue';
export default {
    data() {
        return {
            credit: {},
            title: '',
            selectedComponent: ''
        }
    },
    components: {
        NavComponent,
        CreditList,
        InformationComponent,
        PaymentForm,
        SearchByPhoneNumber,
        StatusFilter,
        CreditPayments,
    },
    created() {
        EventBus.$on('open-payment-modal', this.openModalCredit)
        EventBus.$on('show-credit-payments', this.showCreditPayments)
    },
    methods: {
        openModalCredit(credit) {
            Vue.set(this.$data, 'credit', credit);
            this.title = "Crear Pago"
            this.selectedComponent = "payment-form"
            EventBus.$emit("open-modal", true);
        },
        showCreditPayments(credit) {
            Vue.set(this.$data, 'credit', credit);
            this.title = "Lista de Pagos"
            this.selectedComponent = "credit-payments"
            EventBus.$emit("open-modal", true);
        }
    }
}
</script>
