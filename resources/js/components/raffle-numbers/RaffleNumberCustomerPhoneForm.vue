<template>
    <form class="space-y-2 flex flex-col items-start justify-start mb-4" @submit.prevent="handleSubmit">
        <p class="text-xs text-slate-500">
            {{ saleContext }}
        </p>
        <label for="customer_phone" class="text-left w-full">Número de teléfono</label>
        <input type="text" id="customer_phone" v-model="customerPhone" class="input-style w-full"
            placeholder="Ingrese el número de teléfono del cliente">
        <div v-if="error" class="text-red-500 bg-red-100 rounded-sm w-full p-1 transition-all">
            {{ error }}
        </div>
        <button type="submit" class="primary-button w-full">
            Guardar
        </button>
    </form>
</template>
<script>
export default {
    props: {
        raffleNumber: {
            type: Object,
        }
    },
    data() {
        return {
            customerPhone: this.raffleNumber?.customer_phone || '',
            error: null
        }
    },
    methods: {
        async handleSubmit() {
            try {
                const resp = await axios.patch(`/raffle-numbers/${this.raffleNumber?.id}/customer-phone`, {
                    customer_phone: this.customerPhone
                });
                this.$emit('raffle-number-customer-phone-updated', this.customerPhone);

            } catch (error) {
                console.error(error);
                this.error = error.response?.data?.message || 'Ocurrió un error al actualizar el número de teléfono del cliente.';
            }
        }
    },
    computed: {
        saleContext() {
            const saleType = this.raffleNumber?.saleable_type || 'Venta';
            const ticketNumber = this.raffleNumber?.ticket_number || '-';

            return `${saleType} · Nota ${ticketNumber}`;
        }
    },
    watch: {
        raffleNumber: {
            handler(newVal) {
                this.customerPhone = newVal?.customer_phone || '';
            },
            immediate: true
        },
        error: {
            handler(newVal) {
                if (newVal) {
                    setTimeout(() => {
                        this.error = null;
                    }, 3000);
                }
            }
        }
    },

}

</script>
