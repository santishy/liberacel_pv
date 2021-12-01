<template>
    <form @submit.prevent="submit">
        <div class="flex items-center border-b border-teal-500 py-2">
            <input
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                type="text"
                placeholder="Número de teléfono del cliente."
                name="phone_number"
                v-model="form.phone_number"
                aria-label="Full name"
            />

            <button
                class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded"
                type="submit"
            >
                Venta a cliente
            </button>
            <information-component>
                <template v-slot:title>Información del cliente</template>
                <template v-if="Object.keys(client).length">
                    <p class="text-sm text-gray-700">{{ client.name }}</p>
                    <p class="text-sm text-gray-700">{{ client.address }}</p>
                    <p class="text-sm text-gray-700">
                        {{ client.phone_number }}
                    </p>
                    <p class="text-sm text-gray-700">{{ client.company }}</p>
                </template>
            </information-component>
        </div>
        <div  class="flex items-center ">
            <errors-component :errors-found="errors" />
        </div>
    </form>
</template>
<script>
import InformationComponent from "../modals/InformationComponent.vue";
export default {
    components: {
        InformationComponent
    },
    data() {
        return {
            form: {},
            client: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/sales-to-clients", this.form)
                .then(res => {
                    EventBus.$emit("open-modal", true);
                    this.client = res.data.sale.client;
                    EventBus.$emit("sale-to-client", res.data);
                })
                .catch(err => {
                    this.getErrors(err);
                });
        }
    }
};
</script>
