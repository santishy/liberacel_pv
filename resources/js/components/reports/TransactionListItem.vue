<template>
    <tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2">{{ transaction.username }}</td>
        <td v-if="areTheySales" class="border px-4 py-2">{{getCustomerName}}</td>
        <td class="border px-4 py-2">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2">{{ transaction.total }}</td>
        <td class="border px-4 py-2">
            <modal-component
                :transaction="transaction"
            >
            </modal-component>
        </td>
        <td>
            <cancel-transaction
                :uri="uri"
                :transaction="transaction"
            ></cancel-transaction>
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
        uri:{
            type: String
        },
        index:{
            type:Number
        },
        areTheySales:{
            type: Boolean
        }
    },
    components: {
        "modal-component": Modal,
        CancelTransaction
    },
    computed:{
        getCustomerName(){
            return this.transaction.client ? this.transaction.client.name : "Publico en general"
        }
    }
};
</script>
