<template>
    <div>
        <payment-list :credit="credit"></payment-list>
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
