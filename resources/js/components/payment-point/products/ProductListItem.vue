<template>
    <tr>
        <td class="py-1 px-2">{{ product.description }}</td>
        <td class="py-1 px-2 ">{{ product.price }}</td>
        <td class=" py-1 px-2 ">{{ product.qty }}</td>
        <td class="py-1 px-2">{{ product.qty * product.price }}</td>
    </tr>
</template>
<script>
export default {
    props: ['product', 'index']
}
</script>
