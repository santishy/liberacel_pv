<template>
    <div class="bg-white rounded-sm ">
        <product-list :products="products"></product-list>
    </div>
</template>
<script>
import ProductList from './ProductList.vue';
export default {
    props: {
        products: {
            type: Array,
            default: () => []
        }
    },
    components: {
        ProductList
    }
}
</script>
