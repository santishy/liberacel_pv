<template>
    <form @submit.prevent="submit" class="w-full px-2 py-2  flex flex-col gap-2">
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
        <div class="px-4 py-1 ">
            <label class="form-label">Monto</label>
            <input type="number" v-model="form.amount" class="form-text-input w-full placeholder:text-slate-300"
                placeholder="Monto" autocomplete="off" />
        </div>
        <div class=" py-1 ">
            <button>Abonar</button>
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
                const res = axios.post('payments', this.form)
                console.log({ res });
            } catch (err) {
                console.log(err)
            }
        }
    }
}
</script>