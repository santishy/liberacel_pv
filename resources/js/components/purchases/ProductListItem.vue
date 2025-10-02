<template>
    <tr class="text-slate-500">
        <td class="px-4 py-3 border">
            <div class="font-semibold text-slate-600">
                {{ localProduct.sku }}
            </div>
        </td>
        <td class="px-4 py-3 border ">
            {{ localProduct.category_name }}
        </td>
        <td class="px-4 py-3 border ">
            {{ localProduct.description }}
        </td>
        <td class="px-4 py-3 border  ">
            <input type="number" v-model="localProduct.purchase_price" class="form-text-input w-full" />
        </td>
        <td class="px-4 py-3 border ">
            <input type="number" v-model="localProduct.purchase_quantity" class="form-text-input w-full" />
        </td>
        <td class="px-4 py-3 border ">
            {{ getTotal }}
        </td>
        <td class="px-4 py-3 border ">
            <div class="flex flex-wrap gap-2">
                <button @click="update"
                    class="bg-sky-500 text-slate-100 rounded p-1 px-2 text-center hover:bg-sky-700 hover:text-white">
                    <edit-icon></edit-icon>
                </button>
                <button @click="destroy" class="bg-red-500  text-slate-100  hover:bg-red-400 p-1 px-2 rounded ">
                    <trash-icon></trash-icon>
                </button>
            </div>
        </td>
    </tr>
</template>
<script>
import { mapMutations, mapGetters } from "vuex";
import EditIcon from "../icons/EditIcon.vue";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components: { TrashIcon, EditIcon },
    props: {
        product: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    data() {
        return {
            localProduct: this.product
        };
    },
    methods: {
        ...mapMutations(["setProductsInPurchase", "deleteProductInPurchase"]),
        update() {
            axios
                .post(`/products-in-purchases/${this.localProduct.id}`, {
                    ...this.localProduct,
                    ...{ _method: "put" }
                })
                .then(res => {
                    if (res.data.totalPurchase) {
                        EventBus.$emit(
                            "total-updated-purchase",
                            res.data.totalPurchase
                        );
                        var obj = new Object();
                        obj.hasProductsInPurchase = this.hasProductsInPurchase;

                        obj.index = this.productExistsInPurchase(
                            this.localProduct.id
                        );

                        obj.productInPurchase = {
                            qty: this.localProduct.purchase_quantity,
                            product_id: this.localProduct.id
                        };
                        this.setProductsInPurchase(obj);
                    }
                })
                .catch(err => {
                    const message = err.response.data?.errors ? Object?.values(
                            err?.response?.data?.errors
                        )?.flat()[0] : err.response.data.message;

                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: message
                    });
                });
        },
        destroy() {
            axios
                .delete(`/products-in-purchases/${this.localProduct.id}`)
                .then(res => {
                    if (res.data) {
                        let index = this.productExistsInPurchase(
                            this.localProduct.id
                        );

                        this.deleteProductInPurchase(index);
                        EventBus.$emit("purchase-extracted", this.index);
                        EventBus.$emit(
                            "total-updated-purchase",
                            res.data.totalPurchase
                        );
                    }
                })
                .catch(err => {
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: Object?.values(
                            err?.response?.data?.errors
                        )?.flat()[0]
                    });
                });
        }
    },
    computed: {
        ...mapGetters(["hasProductsInPurchase", "productExistsInPurchase"]),
        getTotal() {
            return (
                this.localProduct.purchase_price *
                this.localProduct.purchase_quantity
            );
        }
    }
};
</script>
