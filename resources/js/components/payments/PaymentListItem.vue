<template>
    <tr>
        <td class="py-1 px-2 text-xs">{{ payment.created_at }}</td>
        <td v-if="show" @dblclick="showInput" class="py-1 px-2 text-green-800 font-semibold">{{ payment.currency_amount
            }}
        </td>
        <td v-else class="py-1 px-2">
            <input type="text" :ref="`amount_${index}`" @keydown.enter="updatePayment" v-model="amount"
                class="form-text-input !p-1" />
        </td>
        <td class="py-1 px-2 flex flex-wrap justify-center items-center gap-2">
            <button @click.prevent="showInput" class="text-sky-500 font-bold">
                <svg fill="none" stroke="currentColor" class="h-4 w-4" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                    </path>
                </svg>
            </button>
            <button @click.prevent="deletePayment" class="text-red-500 font-bold">
                <trash-icon></trash-icon>
            </button>
        </td>
    </tr>
</template>
<script>

import axios from "axios";
import TrashIcon from "../icons/TrashIcon.vue"
export default {
    props: {
        payment: {
            type: Object,
            default: () => { }
        },
        index: {
            type: Number
        },

    },
    components: { TrashIcon },
    data() {
        return {
            show: true,
            amount: this.payment.amount || 0,
        }
    },
    methods: {
        showInput() {
            this.show = !this.show;
            if (!this.show) {
                this.$nextTick(() => {
                    this.$refs[`amount_${this.index}`].focus();
                });
            }
        },
        async deletePayment() {
            try {
                const res = await axios.delete(`/payments/${this.payment.id}`);

                if (res.data) {
                    EventBus.$emit(
                        "updated-payment", { data: res.data, index: this.index }
                    )
                }
            } catch (err) {
                this.$notify({
                    group: "foo",
                    title: "Cliente",
                    type: "error",
                    text: Object?.values(
                        err?.response?.data?.errors
                    )?.flat()[0]
                });
            }
        },
        async updatePayment() {
            try {
                const res = await axios.put(
                    `/payments/${this.payment.id}`,
                    { amount: this.amount }
                )
                if (res.data) {
                    this.show = true;
                    EventBus.$emit(
                        "updated-payment", { data: res.data, index: this.index }
                    )
                }
            } catch (err) {
                this.$notify({
                    group: "foo",
                    title: "Cliente",
                    type: "error",
                    text: Object?.values(
                        err?.response?.data?.errors
                    )?.flat()[0]
                });
            }
        }

    }
}
</script>
