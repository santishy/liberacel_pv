<template>
    <form @submit.prevent="submit">
        <errors-component class="mb-2" :errors-found="errors" />
        <div class="flex flex-wrap">
            <input
                class="text-center  appearance-none bg-gray-300 border-none rounded text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="number"
                name="stock"
                v-model="form.stock"
            />
        </div>
    </form>
</template>

<script>
import EditIcon from "../icons/EditIcon.vue";
export default {
    components: { EditIcon },
    props: {
        product: { type: Object },
        inventory: { type: Object },
        index: { type: Number }
    },
    data() {
        return {
            form: { stock: this.product.stock, product_id: this.product.id }
        };
    },
    methods: {
        submit() {
            this.form._method = "put";
            axios
                .post("/inventories/" + this.inventory.id, this.form)
                .then(res => {
                    EventBus.$emit("updated-stock", {
                        index: this.index,
                        newStock: res.data.newStock
                    });
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
