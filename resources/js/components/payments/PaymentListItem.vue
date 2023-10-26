<template>
    <tr>
        <td class="py-1 px-2 text-xs">{{ payment.created_at }}</td>
        <td class="py-1 px-2 text-green-800 font-semibold">{{ payment.currency_amount }}</td>
        <td class="py-1 px-2">
            ...
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

};
</script>
