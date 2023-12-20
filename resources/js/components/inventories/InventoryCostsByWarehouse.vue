<template>
    <div class="px-4 py-2 rounded bg-white shadow text-center text-lg font-semibold">
        <span class="text-slate-700">Total: </span> <span class="text-slate-800">{{ total_cost }}</span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            total_cost: 0,
            inventory_id: null,
        }
    },
    created() {
        EventBus.$on("selected-inventory", inventory => {
            this.inventory_id = inventory.id;
            this.getTotalCost();
        })
    },
    methods: {
        getTotalCost() {
            axios.get(`/warehouse-costs/${this.inventory_id}`)
                .then(res => {
                    if (res?.data) {
                        this.total_cost = res.data.total_cost;
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>
