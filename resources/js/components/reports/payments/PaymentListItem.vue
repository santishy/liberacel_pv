<template>
    <tr>
        <td class="py-1 px-2 text-xs">{{ payment.created_at }}</td>
        <td class="py-1 px-2">{{ payment.credit.id }}</td>
        <td class="py-1 px-2">{{ payment.amount }}</td>
        <td class="py-1 px-2 text-sm">{{ payment.client.name }}</td>
        <td class="py-1 px-2 font-semibold text-green-800">
            {{ payment.credit.formatted_amount_paid }}
        </td>
        <td class="py-1 px-2 font-extralight text-green-800">
            {{ payment.credit.total_amount_formatted }}
        </td>
        <td class="py-1-px-2">

        </td>
    </tr>
</template>
<script>


export default {
    props: {
        payment: {
            type: Object
        },
        index: {
            type: Number
        },

    },

};
</script>
