<template>
    <div>
        <form @submit.prevent="submit">
            <div class="flex items-center border-b border-teal-500 py-2">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text" placeholder="Número de teléfono del cliente." name="phone_number"
                    v-model="form.phone_number" aria-label="Full name" />
                <button class="flex-shrink-0 text-sm border-4 text-white py-1 px-2 rounded" :class="associatedClient
                    ? 'bg-sky-500 hover:bg-sky-700 border-sky-500 hover:border-sky-700'
                    : 'bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700'">
                    {{ textButton }} </button>
            </div>

        </form>
        <information-component :id="'client'">
            <template v-slot:title>Información del cliente</template>

            <template v-if="Object.keys(client).length">
                <div class="border-t border-b py-2 border-slate-300 flex flex-col gap-1 justify-start items-start">

                    <p class="uppercase border-yellow-400 border text-sm  text-slate-700 px-2 py-1 rounded-sm">
                        {{
                            client.name }}
                    </p>
                    <p class="border-yellow-400 border text-sm text-slate-500  px-2 py-1 rounded-sm">{{
                        client.address
                    }}</p>
                    <p class=" border-yellow-400 border text-sm text-slate-700 px-2 py-1 rounded-sm">
                        {{ client.phone_number }}
                    </p>
                    <p class="border-yellow-400 border text-sm text-slate-500 px-2 py-1 rounded-sm">{{
                        client.company }}
                    </p>
                </div>
            </template>
        </information-component>
    </div>
</template>

<script>

import InformationComponent from "../../modals/InformationComponent.vue";
export default {
    props: {
        uri: {
            type: String,
            required: true,
        },
        sale: {
            type: Object,
            default: () => ({}),
        }
    },
    components: {
        InformationComponent
    },
    data() {
        return {
            form: {},
            client: {},
            uriCopy: null,
            method: 'POST',
        };
    },
    mounted() {
        this.uriCopy = this.uri;
        EventBus.$on('associated-user', () => {
            this.form = {};
            this.client = {};
        })
    },
    methods: {
        submit() {
            if (sessionStorage.getItem('inventory_id')) {
                this.form.inventory_id = sessionStorage.getItem('inventory_id');
            }

            axios(this.axiosConfig)
                .then(res => {
                    EventBus.$emit(`open-modal-client`, true);
                    if (res.data?.sale) {
                        this.client = res.data.sale.client;
                    }
                    else {

                        this.client = res.data.data
                    }

                    EventBus.$emit("product-added-sales-cart", res.data.sale)

                    EventBus.$emit("sale-to-client", res.data);
                })
                .catch(err => {
                    this.$notify({
                        group: "foo",
                        title: "Cliente",
                        type: "error",
                        text: Object?.values(
                            err?.response?.data?.errors
                        )?.flat()[0]
                    });
                });
        },

    },
    watch: {
        sale: {
            handler(newValue) {
                if (newValue?.client) {
                    this.client = newValue.client;
                    this.form.phone_number = newValue.client.phone_number;
                }
            },
            immediate: true,
        }
    },
    computed: {
        axiosConfig() {
            if (this.uriCopy === '/clients/' ||
                this.uriCopy === `/clients/${this.form.phone_number}`) {
                this.uriCopy = this.uri + this.form.phone_number;
                this.method = 'GET'
            } else {
                this.method = 'POST';
            }
            return {
                url: this.uriCopy,
                method: this.method,
                data: this.form,
            }
        },
        textButton() {
            return Object.keys(this.client).length > 0 ? 'Cambiar cliente' : 'Asociar cliente';
        },
        associatedClient() {
            return Object.keys(this.client).length > 0;
        },
    }

};
</script>
