<template>
    <tr>
        <td>
            {{expense.created_at}}
        </td>
        <td>
            {{expense.concept}}
        </td>
        <td>
            {{expense.amount}}
        </td>
        <td>

        </td>
    </tr>
</template>

<script>
export default {
    props:{
        expense:{
            type:Object
        }
    }
}
</script>
