<template>
    <div>
        <payment-list class="bg-green-100 !shadow-none" :credit="credit"></payment-list>
    </div>
</template>

<script>
import PaymentList from "../../payments/PaymentList.vue"
export default {
    components: {
        PaymentList
    },
    props: {
        credit: {
            type: Object,
            default: () => { }
        }
    }

}
</script>
