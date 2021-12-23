<template>
<tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2">{{ transaction.username }}</td>
        <td v-if="areTheySales" class="border px-4 py-2">{{getCustomerName}}</td>
        <td class="border px-4 py-2">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2">{{ transaction.total }}</td>
        <td class="border px-4 py-2">
        </td>
    </tr>
    
</template>
<script>
export default {
    props:{

    }
}
</script>