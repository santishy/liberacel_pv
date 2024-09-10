<template>
    <div class="relative overflow-x-auto bg-white">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class="text-xs text-slate-700 uppercase bg-gray-100">
                <tr
                    class="text-md font-semibold tracking-wide text-left text-slate-800 bg-slate-100 uppercase border-b border-slate-600">
                    <th class="px-4 py-3">SKU</th>
                    <th class="px-4 py-3">Categoría</th>
                    <th class="px-4 py-3">Descripción</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Cantidad</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <product-list-item v-for="(product, index) in products" :key="product.id" :index="index"
                    :product="product">
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
