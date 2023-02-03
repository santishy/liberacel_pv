<template>
    <div class="flex flex-wrap justify-center">
        <input v-model="localProduct.sale_quantity" @keyup.prevent="handleRefund" name="qty"
            class="px-4 py-2 text-center sm:w-3/12" type="text" :class="[
                disabled
                    ? 'bg-gray-100 text-gray-400'
                    : 'bg-gray-100 text-gray-600',
            ]" placeholder="Precio de venta" aria-label="Full name" :disabled="disabled" />
        <button @click.prevent="decrease" class="px-3 py-2 rounded-r text-center font-bold shadow-sm" :class="[
            disabled
                ? 'bg-gray-100 text-gray-400'
                : 'bg-gray-200 text-gray-700',
        ]" :disabled="disabled">
            -
        </button>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
        },
        saleId: {
            type: Number,
        },
    },
    data() {
        return {
            disabled: false,
            localProduct:{}
        };
    },
    created() {
        this.localProduct = {...this.product}
        EventBus.$on("enabled", this.enabled);
    },
    methods: {
        async handleRefund() {
            this.disabled = true;
            if(this.product.sale_quantity === '')
            {
                this.disabled=false;
                return;
            }
            EventBus.$emit('refund-product', {
                qty: this.localProduct.sale_quantity,
                product_id: this.product.id,
                sale_price: this.product.sale_price,
                sku: this.product.sku,
                refund_amount: this.product.sale_quantity - this.localProduct.sale_quantity
            });
            // try{

            //     const res = await axios.post("/refunds", {
            //         qty: this.product.sale_quantity,
            //         product_id: this.product.id,
            //         sale_id: this.saleId,
            //     });
            // } catch (err) {
            //     console.log(err)
            // }
            this.disabled = false;
        },
        async decrease() {
            if (this.localProduct.sale_quantity > 0) this.localProduct.sale_quantity -= 1;
            await this.handleRefund();
        },

        enabled() {
            this.disabled = false;
        },
    },
};
</script>

