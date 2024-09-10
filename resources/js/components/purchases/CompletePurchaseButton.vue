<template>
    <button class="rounded px-4 py-1 bg-teal-600 hover:bg-teal-400 text-white mr-4"
        :class="{ 'opacity-50 cursor-not-allowed': isProcessing }" :disabled="isProcessing" @click="completePurchase">
        <i class="far fa-check-circle"></i> Completar
    </button>
</template>

<script>
export default {
    props: {
        purchase: {
            type: Object,
        },
        totalPurchase: {
            type: Number,
        },
    },
    data: () => {
        return {
            inventory_id: null,
            isProcessing: false,
        };
    },
    mounted() {
        EventBus.$on("selected-inventory", (id) => {
            this.inventory_id = id;
        });
    },
    methods: {
        async completePurchase() {
            this.isProcessing = true;
            try {
                const res = await axios.put(`/purchases/${this.purchase.id}`, {
                    status: "completed",
                    total: this.totalPurchase,
                    _method: "put",
                    inventory_id: this.inventory_id
                        ? this.inventory_id
                        : this.user.inventory_id,
                });

                EventBus.$emit("purchase-completed", res.data.data);
                if (res.data.data.status === "COMPLETADA") {
                    localStorage.removeItem("productsInPurchase");
                }
            } catch (err) {
                this.getErrors(err);
            }
            // this.isProcessing = false;
        },
    },
};
</script>
