<template>
    <layout-component>

        <expense-list uri="/expenses" name="Expenses"></expense-list>

    </layout-component>
</template>

<script>
//import NavComponent from "../NavComponent.vue";
import ExpenseList from "./ExpenseList.vue";
export default
    {
        components: {
            //          NavComponent,
            ExpenseList
        }
    }
</script>
