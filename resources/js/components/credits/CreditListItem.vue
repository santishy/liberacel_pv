<template>
    <tr>
        <td class="text-center">
            {{ credit.created_at }}
        </td>
        <td class="text-center">
            {{ credit.client.name }}
        </td>
        <td class="text-center">
            {{ credit.amount_paid_formatted }}
        </td>
        <td class="text-center">
            {{ credit.formatted_total_amount }}
        </td>
        <td class="text-center">
            <div class="flex flex-wrap space-x-2 items-center w-full justify-center">
                <a :href="`/credits/${credit.id}/edit`">
                    <edit-icon></edit-icon>
                </a>
                <!-- <delete-expense :expense="expense" :index="index"></delete-expense> -->
            </div>
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
