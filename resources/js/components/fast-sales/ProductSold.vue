<template>
    <tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2">{{ transaction.user_name }}</td>
        <td class="border px-4 py-2">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2">{{ transaction.description }}</td>
        
        <td class="border px-4 py-2">{{ transaction.price }}</td>
        <td class="border px-4 py-2">{{ transaction.qty }}</td>
        <td class="border px-4 py-2">
            ${{ transaction.qty * transaction.price }}
        </td>
        <td class="border px-4 py-2 text-green-800 font-semibold">${{ transaction.total }}</td>
        <td class="border px-4 py-2">
            <a
                :href="`/fast-sale-tickets/${transaction.id}`"
                class="cursor-pointer block p-2 text-blue-600"
                target="_blank"
            >
                Imprimir
            </a>
        </td>
    </tr>
</template>
<script>
export default {
    props: {
        transaction: {
            type: Object,
        },
    },
};
</script>
