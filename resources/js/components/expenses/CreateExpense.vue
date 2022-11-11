<template>
    <nav-component>
        <div class="w-full p-4  flex flex-wrap flex-col items-center  justify-center">
            <h3 class="bg-white shadow-sm rounded-sm p-2 mb-2 w-10/12 text-center text-xl font-medium">Crear Egreso</h3>
            <expense-form method="POST"></expense-form>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import ExpenseForm from "./ExpenseForm.vue";
export default {
    components:{
        NavComponent,
        ExpenseForm
    }
}
</script>
