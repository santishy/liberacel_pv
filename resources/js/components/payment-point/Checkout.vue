<template>
    <nav-component>
        <div class="max-w-4xl m-auto bg-white rounded shadow p-4">
            <h1 class="font-bold text-2xl text-slate-800 p-2 text-center">Caja de cobro</h1>
            <div class="flex px-4 py-3 w-full gap-4 border border-gray-200 mb-4 rounded-sm">
                <div class="flex items-center gap-2 ">
                    <input id="inline-radio" type="radio" v-model="show" @change="focusBarcodeInput" :value="true"
                        name="inline-radio-group"
                        class="w-4 h-4 text-blue-600  bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                    <label for="inline-radio" class="cursor-pointer text-sm font-medium text-gray-900 ">Lector</label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="inline-2-radio" type="radio" v-model="show" @change="focusSearchSelect" :value="false"
                        name="inline-radio-group"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                    <label for="inline-2-radio" class=" cursor-pointer text-sm font-medium text-gray-900">Manual</label>
                </div>
            </div>
            <form class="w-full" v-if="show" @submit.prevent="processBarcodeForm">
                <div class="">
                    <input name="checkout" ref="barcode" placeholder="Haz click y escanea el codigo de barras"
                        v-model="barcode" class="w-full px-4 py-2 rounded-sm bg-slate-200" />
                </div>
            </form>
            <form class="w-full" v-else @submit.prevent="processManualForm">
                <div class="flex flex-wrap gap-4">
                    <div class=" flex-grow">
                        <label class="form-label">Categoría</label>
                        <search-select :collection="options" input-class="form-text-input w-full" />
                    </div>
                    <div class=" flex-grow">
                        <label class="form-label">Nota</label>
                        <input type="number" v-model="id" class="form-text-input w-full"
                            placeholder="Escribe el número de nota" @keydown.enter="processManualForm"
                            autocomplete="off" />
                    </div>
                </div>
            </form>
        </div>
        <errors-component :errors-found="errors" class="max-w-4xl m-auto mt-4" />
        <sale-details-checkout class="max-w-4xl m-auto mt-4" v-if="products.length" :sale-details="saleDetails" />
        <products v-if="products.length" class="max-w-4xl m-auto mt-4" :products="products" />
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import SearchSelect from "../partials/SearchSelect.vue";
import Products from "./products/Index.vue";
import SaleDetailsCheckout from "./SaleDetailsCheckout.vue";
export default {
    components: {
        NavComponent,
        SearchSelect,
        Products,
        SaleDetailsCheckout
    },
    created() {
        this.focusBarcodeInput();
        EventBus.$on('selected-item', item => {
            if (!item) {
                return;
            }
            this.model = item.value;
        });
        EventBus.$on("clean-checkout", () => {
            this.products = [];
            this.saleDetails = null;
            if (this.show) this.focusBarcodeInput()
            else
                this.focusSearchSelect();
        })
    },
    data() {
        return {
            barcode: '',
            model: null,
            id: null,
            show: true,
            options: [
                { name: 'Express', value: 'FastSale' },
                { name: 'Stock', value: 'Sale' }
            ],
            products: [],
            saleDetails: null
        }
    },
    methods: {
        focusSearchSelect() {
            this.$nextTick(() => {
                EventBus.$emit('focus-search-select');
            });
        },
        async submit() {
            try {
                if (!this.model || !this.id) {
                    console.warn(`Warning: Either 'model' or 'id' variable is empty or null. Model: ${this.model}, ID: ${this.id}`);
                    return;
                }
                const res = await axios.post('/checkout', { model: this.model, id: this.id });

                if (res.data.products) {
                    this.products = res.data.products;
                }
                delete res.data.products;
                this.saleDetails = res.data;
            } catch (error) {
                this.getErrors(error);
                console.error(error);
            }

        },
        async processBarcodeForm() {

            this.parseBarcodeData();
            await this.submit();
            this.barcode = '';
            this.focusBarcodeInput();
        },
        async processManualForm() {
            await this.submit();
            this.id = null;
            this.model = null;
            EventBus.$emit('reset-search-select');
            this.focusSearchSelect();
        },
        focusBarcodeInput() {
            this.$nextTick(() => {
                if (this.$refs?.barcode) this.$refs.barcode.focus();
            });
        },
        parseBarcodeData() {
            const [model, id] = this.barcode.split('-');
            this.model = model;
            this.id = id;
        }
    }
}
</script>
