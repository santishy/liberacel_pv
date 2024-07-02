<template>
    <tr class="py-2 px-1">
        <td class="py-1 px-2 text-xs">
            {{ credit.created_at }}
        </td>
        <td class="py-2 px-2">
            {{ credit.status }}
        </td>
        <td class="py-1 px-2">
            {{ credit.client.name }}
        </td>
        <td class="py-1 px-2">
            {{ credit.client.phone_number }}
        </td>
        <td class="py-1 px-2 text-green-800">
            {{ credit.formatted_amount_paid }}
        </td>
        <td class="py-1 px-2 font-semibold text-green-800">
            {{ credit.total_amount_formatted }}
        </td>
        <td class="py-1 px-2 flex justify-center gap-1">
            <button
                class="bg-white border text-xs border-green-600 items-center justify-center flex flex-wrap gap-1 hover:bg-green-700 text-slate-700 hover:text-white duration-150 font-semibold p-1 rounded"
                @click.prevent="openPaymentModal(credit)">
                <svg fill="none" stroke="currentColor" class="w-4 h-4" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                Pagar
            </button>
            <button
                class="bg-white border text-xs border-blue-500 text-sky-700 items-center justify-center flex flex-wrap gap-1 hover:bg-blue-700  hover:text-white duration-150 font-semibold p-1 rounded"
                @click.prevent="showCreditPayments(credit)">
                <svg fill="none" stroke="currentColor" class="w-4 h-4" stroke-width="1.5" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z">
                    </path>
                </svg>
                Ver Pagos
            </button>
            <button
                class="bg-white border text-xs border-blue-500 text-sky-700 items-center justify-center flex flex-wrap gap-1 hover:bg-blue-700  hover:text-white duration-150 font-semibold p-1 rounded"
                @click.prevent="showCreditNotes(credit)">
                <svg data-slot="icon" class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z">
                    </path>
                </svg>
                Tickets
            </button>
        </td>
    </tr>
</template>

<script>
//import DeleteExpense from "./DeleteExpense.vue";
import EditIcon from "../icons/EditIcon.vue"
export default {
    props: {
        credit: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    components: {
        EditIcon,
        //DeleteExpense
    },
    methods: {
        openPaymentModal(credit) {
            EventBus.$emit("open-payment-modal", credit);

        },
        showCreditPayments(credit) {
            EventBus.$emit("show-credit-payments", credit);
        },
        showCreditNotes(credit){
            EventBus.$emit('show-credit-notes',credit);
        }
    }
}
</script>
