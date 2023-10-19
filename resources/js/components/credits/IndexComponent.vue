<template>
    <nav-component>
        <search-by-phone-number />
        <ul class="flex flex-wrap gap-4 w-full ">
            <li>
                <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" required>
                <label for="hosting-small"
                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">STATUS</div>
                        <div class="w-full">PENDIENTE</div>
                    </div>

                </label>
            </li>
            <li>
                <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                <label for="hosting-big"
                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 ">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">STATUS</div>
                        <div class="w-full">PAGADO</div>
                    </div>
                    <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </label>
            </li>
            <li>
                <input type="radio" id="hosting-big" name="hosting" value="cancelled" class="hidden peer">
                <label for="hosting-big"
                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer  peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">STATUS</div>
                        <div class="w-full">CANCELADO</div>
                    </div>
                </label>
            </li>
        </ul>

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
