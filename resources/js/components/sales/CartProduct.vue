<template>
    <form @submit.prevent="submit">
        <div
            class="mt-2 flex  
                flex-wrap items-center justify-center bg-gray-200 px-2 py-4 rounded"
        >
            <p
                class="text-gray-700 text-center w-full col-span-2 flex-none font-semibold"
            >
                {{ product.sku }}
            </p>
            <p
                class="text-gray-700 text-center mb-2 w-full col-span-2 flex-none "
            >
                {{ product.description }}
            </p>

            <div class="w-1/3 flex-grow">
                <label> Cantidad </label>
            </div>
            <div class="w-2/3 flex-grow">
                <input
                    v-model="form.qty"
                    name="qty"
                    class="appearance-none bg-white border-gray-600 border-2 rounded-sm w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="number"
                    placeholder="Cantidad de venta"
                    aria-label="Full name"
                />
            </div>
            <div class="w-1/3 flex-grow mt-2">
                <label> Precio </label>
            </div>
            <div class="w-2/3 flex-grow mt-2">
                <input
                    v-model="form.sale_price"
                    name="qty"
                    class="appearance-none bg-white border-gray-600 border-2 rounded-sm w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text"
                    placeholder="Precio de venta"
                    aria-label="Full name"
                />
            </div>
            <div
                v-if="saleStatus === 'pending'"
                class="w-full flex flex-wrap justify-center"
            >
                <delete-sale-product :id="product.id"> </delete-sale-product>
                <button
                    type="submit"
                    class=" bg-blue-300 font-semibold mt-2 rounded transition-all duration-500 ease-in-out hover:bg-blue-500 text-blue-700  hover:text-white py-2 px-4 border-b-2 border-blue-500 hover:border-transparent w-2/3 "
                >
                    <edit-icon></edit-icon>
                    Modificar
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import DeleteSaleProduct from "./DeleteSaleProduct.vue";
import { mapState } from "vuex";
import EditIcon from "../icons/EditIcon.vue";
export default {
    props: {
        product: {
            type: Object,
            required: true
        },
        index: {
            type: Number
        },
        saleStatus: {
            type: String
        }
    },
    components: { DeleteSaleProduct, EditIcon },
    data() {
        return {
            form: {}
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
                .then(res => {
                    EventBus.$emit("updated-sales-product", {
                        index: this.index,
                        transaction: res.data
                    });
                })
                .catch(err => {
                    console.log(err);
                });
        }
    },
    computed: {
        ...mapState(["salePriceOption"])
    }
};
</script>
