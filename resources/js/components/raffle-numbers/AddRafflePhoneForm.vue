<template>
    <form @submit.prevent="addRafflePhone">
        <div class="flex items-center space-x-2">
            <text-input
                v-model="customer_phone"
                classes="w-full md:w-96 p-1"
                placeholder="Agregar Número de teléfono"
            ></text-input>
            <button
                class="px-4 py-2 bg-sky-400 text-white rounded hover:bg-sky-600"
            >
                Guardar
            </button>
        </div>
        <errors-component class="mt-4" id="raffle-phone-errors" />
    </form>
</template>

<script>
import TextInput from "../ui/TextInput.vue";
export default {
    props: {
        uri: {
            type: String,
            required: true,
        },
        customerPhone: {
            type: String,
            default: "",
        },
    },
    components: { TextInput },
    data() {
        return {
            customer_phone: this.customerPhone ?? "",
        };
    },
    methods: {
        async addRafflePhone() {
            try {
                const { data } = await axios.patch(this.uri, {
                    customer_phone: this.customer_phone,
                });
                if (data.raffle_number) {
                    window.open(
                        "/raffle-numbers/" + data.raffle_number.id + "/ticket",
                        "_blank"
                    );
                } else {
                    this.$notify({
                        group: "foo",
                        title: "Tel. para rifa",
                        text: `Se asignará al número de tel. ${this.customer_phone} boleto al pagar la nota.`,
                        type: "info",
                    });
                }
                this.customer_phone = "";
                this.$emit("raffle-phone-number-saved", {
                    raffle_number: data.raffle_number,
                    customer_phone: data.customer_phone,
                });
                EventBus.$emit("open-modal-edit-raffle-number", false);
            } catch (error) {
                EventBus.$emit("an-error-ocurred-raffle-phone-errors", error);
            }
        },
    },
    // watch: {
    //     customerPhone: {
    //         deep: true,
    //         handler() {
    //             this.customer_phone = this.customerPhone;
    //         },
    //     },
    // },
};
</script>
