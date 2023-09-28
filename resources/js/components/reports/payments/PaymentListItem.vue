<template>
    <tr>
        <td class="border px-4 py-2">{{ payment.created_at }}</td>
        <td class="border px-4 py-2">{{ payment.credit.id }}</td>
        <td class="border px-4 py-2">{{ payment.amount }}</td>
        <td class="border px-4 py-2">{{ payment.client.name }}</td>
        <td class="border px-4 py-2">
            {{ payment.credit.formatted_amount_paid }}
        </td>
        <td class="border px-4 py-2">
            {{ payment.credit.total_amount_formatted }}
        </td>
        <td>

        </td>
    </tr>
</template>
<script>


export default {
    props: {
        payment: {
            type: Object
        },
        uri: {
            type: String
        },
        index: {
            type: Number
        },

    },
    computed: {
        getCustomerName() {
            return this.transaction.client ? this.transaction.client.name : "Publico en general"
        }
    }
};
</script>
