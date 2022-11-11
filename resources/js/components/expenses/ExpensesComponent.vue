<template>
    <nav-component>
        <div  class="w-10/12 mx-auto mt-24 md:mt-24">
            <h3 class="w-full rounded-sm p-4 bg-white shadow-sm text-center font-semibold text-xl">Egresos</h3>
            <expense-list></expense-list>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import ExpenseList from "./ExpenseList.vue";
export default
{
    components:{
        NavComponent,
        ExpenseList
    }
}
</script>
