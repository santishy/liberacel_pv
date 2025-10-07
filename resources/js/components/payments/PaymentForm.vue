<template>
    <form @submit.prevent="submit" class="w-full  py-2  flex flex-col gap-2">
        <errors-component />
        <div
            class="flex justify-end gap-3 rounded-sm text-slate-700 text-lg bg-yellow-400 py-1 px-4 leading-snug items-center">
            <span>Adeudo Total</span>
            <span class=" font-bold ">
                {{ credit.total_amount_formatted }}
            </span>
        </div>
        <div class="bg-slate-50 flex text-xl sm:text-base items-center justify-left text-slate-600 text-left rounded">
            Nombre: {{ credit.client.name }}
        </div>
        <div class="bg-slate-50 text-xl flex sm:text-base items-center justify-left text-slate-600 text-left rounded">
            Número telefonico: {{ credit.client.phone_number }}
        </div>
        <div class=" py-1 border-slate-400">
            <label class="form-label">Monto</label>
            <input type="text" v-model="form.amount" class="form-text-input w-full placeholder:text-slate-400"
                placeholder="Monto" autocomplete="off" />
        </div>
        <div class="w-full">
            <button class="w-full primary-button">
                Guardar
            </button>
        </div>
    </form>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        credit: {
            type: Object,
            default: () => { }
        }
    },
    data() {
        return {
            form: {}
        }
    },
    watch: {
        credit: {
            handler(newValue) {
                this.form.amount = null;
            },
            immediate: true,
            deep: true
        }
    },

    methods: {
        async submit() {
            const { client } = this.credit;
            try {
                if (client) {
                    this.form.client_id = client.id;
                    this.form.credit_id = this.credit.id;
                }
                const res = await axios.post('payments', this.form)
                if (res?.data.payment.credit) {
                    const { payment } = res.data;
                    EventBus.$emit('saved-payment', payment.credit)
                    EventBus.$emit("open-modal", false);
                    window.open(`/payments-pdf/${res.data.payment.id}`, "_blank")
                }
            } catch (err) {
                EventBus.$emit('an-error-ocurred', err);

            }
        }
    }
}
</script>
