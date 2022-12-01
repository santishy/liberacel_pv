<template>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td class="py-4 px-6 w-20">
            <img class="w-100" :src="product?.image_url" :alt="product?.sku" />
        </td>
        <td class="py-4 px-6 font-normal text-gray-800">
            {{ product.sku }}
        </td>
        <td class="py-4 px-6">
            {{ product.description }}
        </td>
        <td class="py-4 px-6">
            <editable-product-quantity :product="product"></editable-product-quantity>
        </td>
        <td class="py-4 px-6">
            <editable-product-price :product="product"></editable-product-price>
        </td>
        <td class="py-4 px-6">
            {{ product.sale_price * product.sale_quantity }}
        </td>
        <td class="py-4 px-6">
            <delete-sale-product :id="product.id" :index="index"></delete-sale-product>
        </td>
    </tr>

</template>

<script>
import DeleteSaleProduct from "./DeleteSaleProduct.vue";
import EditableProductQuantity from "./partials/EditableProductQuantity.vue";
import EditableProductPrice from "./partials/EditableProductPrice.vue";
import { mapState } from "vuex";
import EditIcon from "../icons/EditIcon.vue";
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
        },
        saleStatus: {
            type: String,
        },
    },
    components: { DeleteSaleProduct, EditIcon, EditableProductQuantity, EditableProductPrice },
    data() {
        return {
            form: {},
        };
    },
    created() {
        this.form.qty = this.product.sale_quantity;
        this.form.sale_price = this.product.sale_price;
    },
    methods: {
        submit() {
            this.form._method = "put";
            this.form.product_id = this.product.id;
            if (this.isAdmin)
                this.form.inventory_id = sessionStorage.getItem("inventory_id");
            else {
                thi.form.inventory_id = this.user.inventory_id;
            }
            axios
                .post(`/sales/${this.product.id}/products`, this.form)
                .then((res) => {
                    EventBus.$emit("updated-sales-product", {
                        index: this.index,
                        transaction: res.data,
                    });
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    computed: {
        ...mapState(["salePriceOption"]),
    },
};
</script>
