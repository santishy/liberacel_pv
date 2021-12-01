<template>
    <div class="flex flex-wrap space-x-2 px-2">
        <label
            class="inline-flex items-center mt-3 border p-2 border-gray-300 rounded-lg cursor-pointer "
            v-for="warehouse in warehouses"
            :key="warehouse.id"
        >
            <input
                type="checkbox"
                @change="toggleWarehouse(warehouse, $event)"
                class="form-checkbox h-5 w-5 text-teal-600"
            /><span class="ml-2 text-gray-700">{{ warehouse.name }}</span>
        </label>
    </div>
</template>
<script>
export default {
    props: {
        warehouses: { type: Array }
    },
    data() {
        return {
            selectedWarehouses: []
        };
    },
    methods: {
        toggleWarehouse(warehouse, event) {
            if (!event.target.checked) {
                if (this.selectedWarehouses.includes(warehouse.id)) {
                    const index = this.selectedWarehouses.indexOf(warehouse.id);
                    this.selectedWarehouses.splice(index, 1);
                }
            } else {
                this.selectedWarehouses.push(warehouse.id);
            }

            EventBus.$emit("selected-warehouses", this.selectedWarehouses);
        }
    }
};
</script>
