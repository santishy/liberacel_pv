<template>
    <div>
        <form @submit.prevent="submit" v-can="'create sale'">
            <div v-if="Object.keys(localSale).length">
                <input name="total" type="hidden" :v-model="(form.total = getTotal)" />
            </div>
            <div v-if="errors" class="flex items-center mb-3">
                <errors-component :errors="errors" />
            </div>
            <div class="flex flex-wrap justify-between items-center">

                <!-- <label class="relative inline-flex items-center cursor-pointer">
                    <input v-model="form.is_credit" type="checkbox" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-900 ">A crédito</span>
                </label> -->
                <!-- aqui Termino la venta, solo que lo comente para agregar usuario desde otra parte a la venta -->
                <!-- <button v-show="Object.keys(localSale).length" class="w-2/6 px-3 py-2 rounded " :class="[getClass]">
                    {{ modifyTo }}
                </button> -->
            </div>
        </form>
        <div v-if="localSale !== null" class="overflow-x-auto relative max-h-80 overflow-y-auto">
            <product-list>
                <product-list-item v-for="( product, index ) in  products " :key="product.id" :product="product"
                    :sale-status="getStatus" :index="index">
                </product-list-item>
            </product-list>
        </div>
        <div v-show="products.length" class="
                        flex flex-wrap
                        justify-end
                        items-center
                        my-2
                        px-6 py-2
                        bg-amber-300
                        rounded
                    ">
            <label class="mr-4 text-2xl">Total</label>
            <p class="text-gray-700 text-3xl font-bold">{{ getTotal.toLocaleString("es-MX", {
            style: "currency",
            currency: "MXN",
                }) }}</p>
        </div>

    </div>
</template>

<script>
import { mapMutations } from "vuex";
import ProductListItem from "./ProductListItem";
import ProductList from "./ProductList.vue";
import Errors from "../../mixins/Errors";

export default {
    components: { ProductListItem, ProductList },
    mixins: [Errors],
    data() {
        return {
            form: { is_credit: false },
            products: [],
            localSale: {},
        };
    },
    props: {
        sale: {
            type: Object,
        },
    },
    created() {
        if (this.sale != null) {
            this.localSale = this.sale;
            this.products = this.sale.products;
        }
    },
    mounted() {
        EventBus.$on("updated-sales-product", (obj) => {
            this.products[obj.index].sale_quantity = obj.transaction.qty;
            this.products[obj.index].sale_price = obj.transaction.sale_price;
        });
        EventBus.$on("associated-user", this.printTicket);
        EventBus.$on("product-added-sales-cart", (res) => {
            this.localSale = res;
            this.products = res.products;
        });
        EventBus.$on("product-removed", (index) => {
            this.products.splice(index, 1);
        });
        EventBus.$on("sale-deleted", (res) => {
            if (res) {
                this.products = [];
                this.localSale = {};
                this.form = {};
            }
        });
        EventBus.$on("sale-to-client", (data) => {
            this.localSale = data.sale;
        });
        EventBus.$on("update-cart", data => this.updateCart(data))
    },
    computed: {
        getClass() {
            if (this.getStatus == "pending")
                return "bg-sky-500 text-slate-200 hover:text-sky-800 hover:bg-sky-300";
            if (this.getStatus == "completed")
                return "bg-amber-500 text-slate-200 hover:text-slate-700 hover:bg-amber-300";
        },
        getTotal() {
            var total = 0;
            if (!this.products.length) {
                return this.localSale?.total || "";
            }
            this.products.map((product) => {
                total += product.sale_price * product.sale_quantity;
            });
            return total
        },

        modifyTo() {
            if (this.localSale.status == "pending") return "Finalizar venta";
            if (this.localSale.status == "completed") return `Modificar venta #${this.localSale.id}`;
        },
        getStatus() {
            return this.localSale.status;
        },
    },
    methods: {
        ...mapMutations("sales", ["setSale"]),
        printTicket(id) {
            EventBus.$emit(`open-modal-${id}`, false);
            window.open(`/pdf-tickets/${id}`, "_blank");
            this.clearCurrentSale();
        },
        clearCurrentSale() {
            sessionStorage.removeItem("salePriceOption");
            this.products = []
            this.setSale(null);
        },
        submit() {
            if (this.sale)
                if (this.sale.inventory_id)
                    sessionStorage.setItem("inventory_id", this.sale.inventory_id)

            this.form.inventory_id = this.isAdmin
                ? sessionStorage.getItem("inventory_id")
                : this.user.inventory_id;


            if (this.getStatus === "pending") this.form.status = "completed";
            else this.form.status = "pending";
            axios
                .post(`/sales/${this.localSale.id}`, this.form)
                .then((res) => {
                    this.localSale.status = res.data.sale_status;
                    this.localSale.total = Number(res.data.total);
                    if (this.localSale.status == "completed") {
                        sessionStorage.removeItem("salePriceOption");
                        this.products = []
                    }
                    else if (this.localSale.status === "pending") {
                        this.products = this.localSale.products;
                    }
                    //  this.getBarcodeToSellUrl("stock", this.localSale.id);
                    window.open(`/pdf-tickets/${this.localSale.id}`, "_blank");
                })
                .catch((err) => {
                    this.getErrors(err);
                    this.$notify({
                        group: "foo",
                        title: "Error",
                        type: "error",
                        text: this.errors[0],
                    });
                });
        },
        async getBarcodeToSellUrl(typeOfSale, saleID) {

            try {
                const res = await axios.post("/barcode-to-sell", {
                    type_of_sale: typeOfSale,
                    sale_id: saleID,
                }, {
                    responseType: 'arraybuffer',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf'
                    }
                });
                console.log({ res })
                // Crear un blob desde la respuesta para el contenido del PDF
                const blob = new Blob([res.data], { type: 'application/pdf' });

                // Crear una URL para el blob
                const url = URL.createObjectURL(blob);
                console.log({ url })
                // Abrir la URL en una nueva pestaña
                window.open(url, '_blank');
            } catch (error) {
                console.log(error)
            }
        },

        async updateCart(data) {
            try {
                const res = await axios.post(`/sales/${data?.product_id}/products`,
                    { _method: 'put', ...data }
                );
                EventBus.$emit('enabled');
            } catch (error) {
                this.getErrors(error);
                this.$notify({
                    group: "foo",
                    title: "Error",
                    type: "error",
                    text: this.errors[0],
                });
            }
        }
    },
};
</script>
