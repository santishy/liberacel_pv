<template>
    <form class="p-4 w-full flex justify-center" @submit.prevent="submit">
        <div class="bg-white rounded-sm p-4 w-2/6">
            <label class="block font-medium text-sm text-gray-700 mb-2">
                Observación de devolución
            </label>
            <textarea
                class="appearance-none w-full bg-gray-300 rounded-sm py-2 px-3 text-gray-700 leading-tight outline-none"
                rows="4" v-model="comment"></textarea>
            <button class="bg-blue-500 hover:bg-blue-700 font-bold text-white" type="submit">Crear reembolso</button>
        </div>
        <div class="bg-white rounded-sm p-4 w-2/6">
            <ul class="p-4">
                <li class="flex justify-center gap-4" v-for="product in products" :key="product.product_id">
                    <span class="text-black font-semibold">{{product.sku}}</span>  <span>Reembolso: {{product.refund_amount}}</span>
                </li>
            </ul>
        </div>
    </form>
</template>
<script>
export default {
    props: ['sale'],
    data() {
        return {
            products: [],
            comment: '',
        }
    },
    created() {
        EventBus.$on('refund-product', this.addRefundProducts);
    },
    methods: {
        addRefundProducts({ product_id, qty, sku,refund_amount, sale_price }) {
            let indexFound = null;
            const productExists = this.products.find((product, index) => {
                if (product.product_id === product_id) {
                    indexFound = index;
                    return true;
                }
            }
            );

            if (!productExists) {
                this.products.push({ product_id, qty, sku,refund_amount ,sale_price});
            }
            else {
                this.products[indexFound].qty = qty;
                this.products[indexFound].refund_amount = refund_amount;
            }
        },
        async submit() {
            try {
                const res = await axios.post('/refunds', {
                    comment: this.comment,
                    refund_products: this.products,
                    sale_id: this.sale.id,
                    total_refund: this.getTotalRefund()
                });
                this.notify({
                    title: "Reembolsos",
                    message: "Reembolso realizado",
                });
            } catch (err) {
                console.log(err)
            }

        },
        getTotalRefund(){
            return this.products.reduce((acc,currentValue)=>{
                return acc + (currentValue.refund_amount * currentValue.sale_price)
            },0)
        }
    },

    destroyed() {
        EventBus.$off('refund-product');
    }
}
</script>
