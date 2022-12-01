<template>
    <div class="flex flex-wrap justify-center">
        <button
            @click.prevent="increase"
            :disabled="disabled"
            class="
                px-3
                py-2
                rounded-l
                text-center
                font-bold
                shadow-sm
            "
            :class="[disabled ? 'bg-gray-100 text-gray-400' : 'bg-gray-200 text-gray-700']"
        >
            +
        </button>
        <input
            v-model="product.sale_quantity"
            name="qty"
            class="px-4 py-2 text-center sm:w-3/12 "
            type="text"
            :class="[disabled ? 'bg-gray-100 text-gray-400' : 'bg-gray-100 text-gray-600']"
            placeholder="Precio de venta"
            aria-label="Full name"
            :disabled="disabled"
        />
        <button
            @click.prevent="decrease"
            class="
                px-3
                py-2
                rounded-r
                text-center
                font-bold
                shadow-sm
            "
            :class="[disabled ? 'bg-gray-100 text-gray-400' : 'bg-gray-200 text-gray-700']"
            :disabled="disabled"
        >
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
    },
    data(){
        return {
            disabled:false
        }
    },
    created() {
        this.$watch("product.sale_quantity", this.updateCart);
        EventBus.$on('enabled',this.enabled)
    },
    methods: {
        increase() {
            this.product.sale_quantity += 1;
        },
        decrease() {
            if (this.product.sale_quantity > 0) this.product.sale_quantity -= 1;
            return;
        },
        updateCart(value) {
            let inventory_id = null;
            if (value > 0) {
                if (this.isAdmin)
                    inventory_id = sessionStorage.getItem("inventory_id");
                else {
                    inventory_id = this.user.inventory_id;
                }
                EventBus.$emit("update-cart", {
                    qty: value,
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

