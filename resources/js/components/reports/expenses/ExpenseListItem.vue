<template>
    <tr>
        <td class="text-center">

            {{ expense.created_at }}
        </td>
        <td class="text-center">
            {{ expense.concept }}
        </td>
        <td class="text-center">
            {{ expense.amount }}
        </td>
        <td class="text-center">
            <!-- <div class="flex flex-wrap space-x-2 items-center w-full justify-center">
                <a :href="`/expenses/${expense.id}/edit`">
                    <edit-icon></edit-icon>
                </a>
                <delete-expense :expense="expense" :index="index"></delete-expense>
            </div> -->
            ...
        </td>
    </tr>
</template>

<script>
// import DeleteExpense from "./DeleteExpense.vue";
// import EditIcon from "../icons/EditIcon.vue"
export default {
    props: {
        expense: {
            type: Object
        },
        index: {
            type: Number
        }
    },
    // components: {
    //     EditIcon,
    //     DeleteExpense
    // }
}
</script>
