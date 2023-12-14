<template>
    <div>
        {{ total_cost }}
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
                    console.log(res.data)
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>