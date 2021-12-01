<template>
    <div class="mx-auto">
        <table class="w-full shadow-sm">
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">SKU</th>
                    <th class="px-4 py-3">Categoría</th>
                    <th class="px-4 py-3">Descripción</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Cantidad</th>
                    <th class="px-4 py-3">Total</th>
                    <th  class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <product-list-item
                    v-for="(product, index) in products"
                    :key="product.id"
                    :index="index"
                    :product="product"
                >
                </product-list-item>
            </tbody>
        </table>
    </div>
</template>

<script>
import ProductListItem from "./ProductListItem.vue";
export default {
    components: {
        ProductListItem
    },
    props: {
        products: {
            type: Array
        }
    }
};
</script>
