<template>
    <tr class="bg-white border-b">
        <td class="px-6 py-4">
            <div class="image-container">
                <img :src="product.image_url" loading="lazy" alt="product.sku" class="object-contain md:object-fill" />
            </div>
        </td>
        <th scope="row" class="px-6 py-4 font-medium text-slate-600 whitespace-nowrap ">
            <div class="flex justify-start items-center">
                <span class="mr-2">{{ product.sku }}</span>
                <a :href="`/barcode/${product.sku}`" class="text-blue-700 " target="_blank">
                    <barcode />
                </a>
            </div>
        </th>
        <td class="px-6 py-4">
            {{ product.category_name }}
        </td>
        <td class="px-6 py-4">
            {{ product.description }}
        </td>
        <td class="px-6 py-4">
            {{ product.formatted_wholesale_price }}
        </td>
        <td class="px-6 py-4">
            {{ product.formatted_retail_price }}
        </td>
        <td class="px-6 py-4">
            {{ product.formatted_distributor_price }}
        </td>
        <td class="px-6 py-4">
            <div v-if="queryTypeExists" class="flex flex-wrap justify-center items-center">
                <add-to-purchase v-show="isPurchase" :product_id="product.id"
                    :purchase_price="product.distributor_price">
                </add-to-purchase>
                <add-to-sale v-show="isSale" :index="index" :product="product">
                </add-to-sale>
                <edit-product v-show="isEdit" :product="product"></edit-product>
                <remove-product-component v-show="isRemove" :product="product"
                    :index="index"></remove-product-component>
            </div>
        </td>
    </tr>
</template>
<script>
import AddToPurchase from "../purchases/AddToPurchase.vue";
import AddToSale from "../sales/AddToSale.vue";
import EditProduct from "./EditProduct.vue";
import Barcode from "../icons/Barcode.vue";
import RemoveProductComponent from "./RemoveProductComponent.vue";
import { mapState } from "vuex";
export default {
    props: {
        product: {
            type: Object,
        },
        index: {
            type: Number,
        },
    },
    components: {
        AddToPurchase,
        AddToSale,
        Barcode,
        EditProduct,
        RemoveProductComponent,
    },
    data() {
        return {
            visibleActions: {
                purchase: "toBuy",
                sale: "sell",
                edit: "list",
                delete: "list",
            },
        };
    },
    methods: {
        queryTypeExists() {
            if (!this.queryType) {
                console.log("Debe habilitar queryType en la url");
                return false;
            }
        }
    },
    computed: {
        ...mapState(["queryType"]),
        isPurchase() {
            return (
                this.visibleActions.purchase.toUpperCase() ===
                this.queryType.toUpperCase()
            );
        },
        isSale() {

            return (
                this.visibleActions.sale.toUpperCase() === this.queryType.toUpperCase()
            );
        },
        isEdit() {
            return (
                this.visibleActions.edit.toUpperCase() === this.queryType.toUpperCase()
            );
        },
        isRemove() {
            return (
                this.visibleActions.delete.toUpperCase() === this.queryType.toUpperCase()
            );
        },
    },
};
</script>
<style lang="css">
.image-container {
    width: 100px;
}
</style>
