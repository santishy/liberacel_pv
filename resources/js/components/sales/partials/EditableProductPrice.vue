<template>
    <div class="flex flex-wrap justify-center">

        <input
            v-model="product.sale_price"
            name="sale_price"
            class="px-4 py-2  text-center sm:w-4/12 "
            type="number"
            :class="[disabled ? 'bg-gray-100 text-gray-400' : 'bg-gray-100 text-gray-600']"
            placeholder="Precio de venta"
            aria-label="Full name"
            :disabled="disabled"
        />
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
        },
    },
    data(){
        return {
            disabled:false
        }
    },
    created() {
        this.$watch("product.sale_price", this.updateCart);
        EventBus.$on('enabled',this.enabled)
    },
    methods: {

        updateCart(value) {
            let inventory_id = null;
            if (value > 0) {
                if (this.isAdmin)
                    inventory_id = sessionStorage.getItem("inventory_id");
                else {
                    inventory_id = this.user.inventory_id;
                }
                EventBus.$emit("update-cart", {
                    sale_price: value,
                    product_id: this.product.id,
                    inventory_id: inventory_id,
                });
                this.disabled=true;
            }
        },
        enabled(){
            this.disabled = false;
        }
    },
};
</script>

