<template>
    <layout-component>
        <div class="flex  flex-wrap items-center justify-between gap-4 mb-4">
            <search-by-phone-number />
            <status-filter />
        </div>
        <credit-list />
        <information-component v-show="Object.keys(credit).length">
            <template slot="title">
                {{ title }}
            </template>
            <component :is="selectedComponent" v-if="Object.keys(credit).length" :credit="credit" />
        </information-component>
    </layout-component>
</template>
<script>
import CreditList from './CreditList.vue';
import StatusFilter from './StatusFilter.vue'
//import NavComponent from '../NavComponent.vue';
import CreditPayments from './payments/CreditPayments.vue';
import CreditNotes from './notes/CreditNotes.vue';
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
        //NavComponent,
        CreditList,
        InformationComponent,
        PaymentForm,
        CreditNotes,
        SearchByPhoneNumber,
        StatusFilter,
        CreditPayments,
    },
    created() {
        EventBus.$on('open-payment-modal', this.openModalCredit)
        EventBus.$on('show-credit-payments', this.showCreditPayments)
        EventBus.$on('show-credit-notes', this.showCreditNotes)
        EventBus.$on('updated-payment', this.updateCredit)
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
        },
        showCreditNotes(credit) {
            Vue.set(this.$data, 'credit', credit);
            this.title = "Notas"
            this.selectedComponent = "credit-notes";
            EventBus.$emit("open-modal", true);
        },
        updateCredit(res) {
            const { data } = res;
            /**
             *  aqui hago ...this.credit, para q m conserve el cliente y no volverlo a cargar
             * */
            Vue.set(this.$data, 'credit', {
                ...this.credit,
                ...data.payment.credit
            })
        }
    }
}
</script>
