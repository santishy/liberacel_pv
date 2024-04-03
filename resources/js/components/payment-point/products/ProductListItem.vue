<template>
    <tr>
        <td class="py-1 px-2">{{ product.description }}</td>
        <td class="py-1 px-2 ">{{ formattedPrice }}</td>
        <td class="py-1 px-2 ">{{ product.sale_quantity }}</td>
        <td class="py-1 px-2">{{ subtotal }}</td>
    </tr>
</template>
<script>
export default {
    props: ['product', 'index'],
    data() {
        return {
            currency: new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN'
            })
        }
    },
    computed: {
        subtotal() {
            return this.currency.format(this.product.sale_quantity * this.product.sale_price);
        },
        formattedPrice() {
            return this.currency.format(this.product.sale_price);
        }
    }
}
</script>
