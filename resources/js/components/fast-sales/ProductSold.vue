<template>
<tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2">{{ transaction.description }}</td>
        <td class="border px-4 py-2">{{ transaction.price }}</td>
        <td class="border px-4 py-2">{{ transaction.qty }}</td>
        <td class="border px-4 py-2">{{ transaction.user_name }}</td>
        <td class="border px-4 py-2">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2"></td>        
    </tr>
    
</template>
<script>
export default {
    props:{
        transaction: {
            type:Object
        }
    }
}
</script>