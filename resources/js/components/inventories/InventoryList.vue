<template>
    <ul class="bg-white shadow-sm rounded w-full text-center">
        <li v-for="(inventory, index) in inventories" :key="inventory.id" @click="selectedInventory(index, inventory)"
            class="border-slate-500 border-b last:border-b-0"
            :class="{ 'bg-sky-500 text-white': selectedIndex === index }">
            <a href="#" class="block p-2" @click.prevent="">{{
                inventory.name
            }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            inventories: [],
            selectedIndex: null
        };
    },
    mounted() {
        axios
            .get("/inventories")
            .then(res => {
                this.inventories = res.data.data;
            })
            .catch(err => {
                console.log(err);
            });
    },
    methods: {
        selectedInventory(index, inventory) {
            this.selectedIndex = index;

            sessionStorage.setItem("inventory_id", inventory.id);

            EventBus.$emit("selected-inventory", inventory);
        }
    }
};
</script>
