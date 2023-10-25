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
            credit: {},
            title: '',
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
        EventBus.$on('show-credit-payments', this.showCreditPayments)
    },
    methods: {
        openModalCredit(credit) {
            Vue.set(this.$data, 'credit', credit);
            this.title = "Crear Pago"
            EventBus.$emit("open-modal", true);
        },
        async showCreditPayments(credit) {
            try {
                this.title = "Lista de Pagos"
                const res = await axios.get(`/credit/${credit.id}/payments`)

            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>
