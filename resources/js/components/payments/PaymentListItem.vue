<template>
    <tr>
        <td class="py-1 px-2 text-xs">{{ payment.created_at }}</td>
        <td v-if="show" class="py-1 px-2 text-green-800 font-semibold">{{ payment.currency_amount }}</td>
        <td v-else class="py-1 px-2">
            <input type="text" @keydown.enter="updatePayment" v-model="amount" class="form-text-input !p-1" />
        </td>
        <td class="py-1 px-2">
            <button @click="open">Editar</button>
        </td>
    </tr>
</template>
<script>

export default {
    props: {
        payment: {
            type: Object,
            default: () => { }
        },
        index: {
            type: Number
        },

    },
    data() {
        return {
            show: true,
            amount: this.payment.amount | 0,
        }
    },
    methods: {
        showInput() {
            this.show = !this.show;

        }
    }

};
</script>
