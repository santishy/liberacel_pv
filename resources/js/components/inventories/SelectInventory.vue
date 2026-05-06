<template>
    <layout-component>
        <div class="bg-white p-4 rounded shadow sm:max-w-xl m-auto mt-4 space-y-2">
            <div v-for="inventory in inventories" class="border border-gray-200 bg-gray-100 px-4 py-2 rounded">
                <input :id="`inventory-${inventory.id}`" type="radio" name="inventory" @change="selectInventory"
                    :value="inventory.id"
                    class="w-4 h-4 text-blue-600 bg-gray-50 border-gray-300 focus:ring-blue-500   focus:ring-2 ">
                <label :for="`inventory-${inventory.id}`"
                    class="ml-2 cursor-pointer text-sm font-medium text-gray-900">{{
                        inventory.name }}</label>
            </div>
        </div>
    </layout-component>
</template>

<script>
import axios from 'axios';

export default {
    created() {

    },
    props: {
        inventories: {
            type: Array,
            required: true
        }
    },
    components: {},
    data() {
        return {

        };
    },
    methods: {
        async selectInventory(event) {
            try {
                const resp = await axios.post('/select-inventory', {
                    inventory_id: event.target.value
                });
                if (resp.status === 200) {
                    window.location.href = '/';
                }
            } catch (error) {
                console.log(error);
                return;
            }

        }
    }
};
</script>
