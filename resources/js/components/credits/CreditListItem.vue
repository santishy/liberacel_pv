<template>
    <tr class="py-2 px-1">
        <td class="text-center">
            {{ credit.created_at }}
        </td>
        <td class="text-center">
            {{ credit.client.name }}
        </td>
        <td class="text-center">
            {{ credit.client.phone_number }}
        </td>
        <td class="text-center">
            {{ credit.formatted_amount_paid }}
        </td>
        <td class="text-center">
            {{ credit.total_amount_formatted }}
        </td>
        <td class="text-center">
            Abonar
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
    }
}
</script>
