<template>
    <form @submit.prevent="submit" class="w-full  py-2  flex flex-col gap-2">
        <div
            class="flex justify-left gap-3 rounded-sm text-slate-700 text-lg bg-yellow-400 py-1 px-4 leading-snug items-center">
            <span>Adeudo Total</span>
            <span class=" font-bold ">
                {{ credit.total_amount_formatted }}
            </span>
        </div>
        <div
            class="px-4 py-1 flex text-xl items-center justify-left text-slate-500 text-left leading-tight border rounded-sm border-slate-400">
            Nombre: {{ credit.client.name }}
        </div>
        <div
            class="px-4 py-1 text-xl flex items-center justify-left text-slate-500 text-left leading-tight border rounded-sm border-slate-400">
            Número telefonico: {{ credit.client.phone_number }}
        </div>
        <div class="border-b border-t py-1 border-slate-400">
            <label class="form-label">Monto</label>
            <input type="text" v-model="form.amount" class="form-text-input w-full placeholder:text-slate-300"
                placeholder="Monto" autocomplete="off" />
        </div>
        <div class="flex items-center mt-2">
            <errors-component :errors-found="errors" />
        </div>
        <div class="w-full py-1 ">
            <button
                class="w-full py-2 bg-white border text-xs border-green-600 items-center justify-center flex flex-wrap gap-2 hover:bg-green-700 text-slate-700 hover:text-white duration-150 font-semibold  px-2 rounded">
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
                this.getErrors(err);
                console.log(err)
            }
        }
    }
}
</script>
