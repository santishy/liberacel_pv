<template>
    <tr>
        <td class="py-1 px-2">{{ transaction.id }}</td>
        <td class="py-1 px-2 text-sm">{{ transaction.user_name }}</td>
        <td class="py-1 px-2 text-xs">{{ transaction.created_at }}</td>
        <td class="py-1 px-2">{{ transaction.description }}</td>
        <td class="py-1 px-2">{{ transaction.price }}</td>
        <td class="py-1 px-2">{{ transaction.qty }}</td>
        <td class="py-1 px-2">${{ transaction.qty * transaction.price }}</td>
        <td class="py-1 px-2 text-green-800 font-semibold">
            ${{ transaction.total }}
        </td>
        <td class="flex items-center justify-center">
            <a
                :href="`/fast-sale-tickets/${transaction.id}`"
                class="cursor-pointer block p-2 text-blue-600"
                target="_blank"
            >
                <printer-icon></printer-icon>
            </a>
            <a
                v-if="transaction.status == 'completed'"
                href="#"
                @click.prevent="openModal"
                class="cursor-pointer block p-2 text-red-600"
            >
                <trash-icon></trash-icon>
            </a>
            <button
                v-if="
                    (transaction.status === 'pending' ||
                        transaction.status === 'completed') &&
                    !transaction.raffle_number_code
                "
                class="bg-sky-400 block text-white font-medium hover:bg-sky-700 hover:text-slate-100 rounded p-1 text-xs"
                @click.prevent="selectedSale(transaction)"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 3.75 18 6m0 0 2.25 2.25M18 6l2.25-2.25M18 6l-2.25 2.25m1.5 13.5c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z"
                    />
                </svg>
            </button>
        </td>
    </tr>
</template>
<script>
import PrinterIcon from "../icons/PrinterIcon.vue";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components: { PrinterIcon, TrashIcon },
    props: {
        transaction: {
            type: Object,
        },
    },
    methods: {
        openModal() {
            EventBus.$emit("open-modal-nota", true);
            EventBus.$emit("id-for-authentication-form", this.transaction.id);
        },
        selectedSale(sale) {
            this.$emit("selected-sale", sale);
        },
    },
};
</script>
