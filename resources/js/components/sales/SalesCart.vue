<template>
    <div>
        <form @submit.prevent="submit" v-can="'create sale'">
            <div v-if="localSale != null">
                <div
                    v-show="products.length"
                    class=" flex flex-wrap justify-center items-center text-center mb-2 bg-teal-100"
                >
                    <label class="mr-4 text-2xl">Total</label>
                    <p class="text-gray-700 text-3xl">${{ getTotal }}</p>
                    <input
                        name="total"
                        type="hidden"
                        :v-model="(form.total = getTotal)"
                    />
                </div>
            </div>
            <div v-if="errors" class="flex items-center mb-3">
                <errors-component :errors="errors" />
            </div>
            <div class="flex flex-wrap justify-center">
                <button
                    v-show="products.length"
                    class=" rounded transition-all duration-500 ease-in-out  font-semibold hover:text-black py-2 px-4 border-l-2 border-r-2 border-green-500 hover:bg-red-500 hover:border-transparent md:w-2/4 w-full"
                    :class="[getClass]"
                >
                    Cambiar a {{ modifyTo }}
                </button>
            </div>
        </form>
        <div v-if="localSale !== null">
            <cart-product
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                :sale-status="getStatus"
                :index="index"
            >
            </cart-product>
        </div>
    </div>
</template>
<script>
import CartProduct from "./CartProduct";
import { mapMutations } from "vuex";
import Errors from "../../mixins/Errors";

export default {
    components: { "cart-product": CartProduct },
    mixins: [Errors],
    data() {
        return {
            form: {},
            products: [],
            localSale: {}
        };
    },
    props: {
        sale: {
            type: Object
        }
    },
    created() {
        if (this.sale != null) {
            this.localSale = this.sale;
            this.products = this.sale.products;
        }
    },
    mounted() {
        EventBus.$on("updated-sales-product", obj => {
            this.products[obj.index].sale_quantity = obj.transaction.qty;
            this.products[obj.index].sale_price = obj.transaction.sale_price;
        });
        EventBus.$on("product-added-sales-cart", res => {
            this.localSale = res;
            this.products = res.products;
        });
        EventBus.$on("product-removed", index => {
            this.products.splice(index, 1);
        });
        EventBus.$on("sale-deleted", res => {
            if (res) {
                this.products = [];
                this.localSale = {};
                this.form = {};
            }
        });
        EventBus.$on("sale-to-client", data => {
            this.localSale = data.sale;
        });
    },
    computed: {
        getClass() {
            if (this.getStatus == "pending")
                return "hover:bg-green-500 text-green-700 bg-green-300";
            if (this.getStatus == "completed")
                return "hover:bg-yellow-500 text-yellow-700 bg-yellow-300";
        },
        getTotal() {
            var total = 0;
            this.products.map(product => {
                total += product.sale_price * product.sale_quantity;
            });
            return total.toFixed(2);
        },

        modifyTo() {
            if (this.localSale.status == "pending") return "Completada";
            if (this.localSale.status == "completed") return "Pendiente";
        },
        getStatus() {
            return this.localSale.status;
        }
    },
    methods: {
        submit() {
            this.form.inventory_id = this.isAdmin
                ? sessionStorage.getItem("inventory_id")
                : this.user.inventory_id;
            if (this.getStatus === "pending") this.form.status = "completed";
            else this.form.status = "pending";
            axios
                .post(`/sales/${this.localSale.id}`, this.form)
                .then(res => {
                    this.localSale.status = res.data.sale_status;
                    if (this.localSale.status == "completed") {
                        sessionStorage.removeItem("salePriceOption");
                    }
                    window.open(`/pdf-tickets/${this.localSale.id}`, '_blank');
                })
                .catch(err => {
                    this.getErrors(err);
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: this.errors[0]
                    });
                });
        }
    }
};
</script>
