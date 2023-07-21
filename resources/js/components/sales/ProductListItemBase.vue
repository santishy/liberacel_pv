<template>
    <tr class="bg-white border-b ">
        <td class="py-1 px-2 w-16">
            <img class="w-100" :src="product?.image_url" :alt="product?.sku" />
        </td>
        <td class="py-1 px-2 font-normal text-gray-700">
            {{ product.sku }}
        </td>
        <td class="py-1 px-2">
            {{ product.description }}
        </td>
        <td class="py-1 px-2">
            <!-- <editable-product-quantity :product="product"></editable-product-quantity> -->
            <slot name="product-qty">
            </slot>
        </td>
        <td class="py-1 px-2">
            <!-- <editable-product-price :product="product"></editable-product-price> -->
            <slot name="product-price"></slot>
        </td>
        <td class="py-1 px-2">
            {{ product.sale_price * product.sale_quantity }}
        </td>
        <td class="py-2 px-2">
            <slot name="product-destroy"></slot>
            <!-- <delete-sale-product :id="product.id" :index="index"></delete-sale-product> -->
        </td>
    </tr>
</template>

<script>
export default {
    props: ['product']
}
</script>
