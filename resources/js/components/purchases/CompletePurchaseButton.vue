<template>
    <button
        class="rounded px-4 py-1 bg-teal-600 hover:bg-teal-400 text-white mr-4"
        @click="completePurchase"
    >
        <i class="far fa-check-circle"></i> Completar compra
    </button>
</template>
<script>
export default {
    props: {
        purchase: {
            type: Object
        },
        totalPurchase: {
            type: Number
        }
    },
    data: () => {
        return {
            inventory_id: null
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", id => {
            this.inventory_id = id;
        });
    },
    methods: {
        completePurchase() {
            axios
                .put(`/purchases/${this.purchase.id}`, {
                    status: "completed",
                    total: this.totalPurchase,
                    _method: "put",
                    inventory_id: this.inventory_id ? this.inventory_id : this.user.inventory_id,
                })
                .then(res => {
                    EventBus.$emit("purchase-completed", res.data.data);
                    if (res.data.data.status === "COMPLETADA") {
                        localStorage.removeItem("productsInPurchase");
                    }
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
