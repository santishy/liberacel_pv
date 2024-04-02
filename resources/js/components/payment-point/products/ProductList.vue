<template>
    <div class="table-container-responsive">
        <table class="report-table">
            <thead class="report-table-thead">
                <tr class="bg-green-200">
                    <th class="py-2 px-2">Descripción</th>
                    <th class="py-2 px-2">Precio</th>
                    <th class="px-2 py-2">Cantidad</th>
                    <th class="px-2 py-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <product-list-item v-for="(product, index) in products" :product="product" :index="index"
                    :key="product.id" />
            </tbody>
        </table>
    </div>
</template>
<script>
import ProductList from '../../inventories/ProductList.vue';
import ProductListItem from './ProductListItem.vue';
export default {
    components: {
        ProductListItem,
        ProductList
    }
}
</script>
