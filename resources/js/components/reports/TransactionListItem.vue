<template>
    <tr>
        <td class="py-1 px-2">{{ transaction.id }}</td>
        <td class="py-1 px-2 text-sm">{{ transaction.username }}</td>
        <td v-if="areTheySales" class=" py-1 px-2 ">{{ getCustomerName }}</td>
        <td class="py-1 px-2 text-xs">{{ transaction.created_at }}</td>
        <td class="py-1 px-2 text-green-800 font-semibold">{{ transaction.formatted_total }}</td>
        <td class="py-1 px-2">
            <modal-component :transaction="transaction">
            </modal-component>
        </td>
        <td class="py-1 px-2">
            <cancel-transaction :uri="uri" :transaction="transaction" :index="index"></cancel-transaction>
        </td>
    </tr>
</template>
<script>
import Modal from "../Modal.vue";
import CancelTransaction from "./CancelTransaction.vue";
export default {
    props: {
        transaction: {
            type: Object
        },
        uri: {
            type: String
        },
        index: {
            type: Number
        },
        areTheySales: {
            type: Boolean
        }
    },
    components: {
        "modal-component": Modal,
        CancelTransaction
    },
    computed: {
        getCustomerName() {
            return this.transaction.client ? this.transaction.client.name : "Publico en general"
        }
    }
};
</script>
