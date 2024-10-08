<template>
    <div class="flex flex-col gap-2">
        <div class="font-mono text-lg text-slate-600 text-start">{{ credit.client.name }}</div>
        <div class="flex flex-wrap justify-end gap-2 p-1 rounded-sm bg-green-200 font-mono text-slate-500">
            <span>Total pagado</span>{{ credit.formatted_amount_paid }}
        </div>
        <div class="flex flex-wrap justify-end gap-2 bg-orange-400 p-1 rounded-sm font-mono text-white">
            <span>Saldo</span>{{ credit.total_amount_formatted }}
        </div>
        <payment-list class="!shadow-none" :credit="credit"></payment-list>
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
