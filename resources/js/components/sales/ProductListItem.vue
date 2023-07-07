<template>
    <product-list-item-base :product="product">
        <template v-slot:product-qty>
            <editable-product-quantity :product="product"></editable-product-quantity>
        </template>
        <template v-slot:product-price>
            <editable-product-price :product="product"></editable-product-price>
        </template>
        <template v-slot:product-destroy>
            <delete-sale-product :id="product.id" :index="index"></delete-sale-product>
        </template>
    </product-list-item-base>
</template>

<script>
import DeleteSaleProduct from "./DeleteSaleProduct.vue";
import EditableProductQuantity from "./partials/EditableProductQuantity.vue";
import EditableProductPrice from "./partials/EditableProductPrice.vue";
import ProductListItemBase from "./ProductListItemBase.vue";
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
    components:
    {
        DeleteSaleProduct, EditIcon, ProductListItemBase,
        EditableProductQuantity, EditableProductPrice
    },
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
