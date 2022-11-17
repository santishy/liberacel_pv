<template>
    <nav-component>
        <div class="w-full p-4  flex flex-wrap flex-col items-center  justify-center">
            <h3 class="bg-white shadow-sm rounded-sm p-2 mb-2 w-10/12 text-center text-xl font-medium">{{ getTitle }}
            </h3>
            <expense-form></expense-form>
        </div>
    </nav-component>
</template>

<script>
import NavComponent from "../NavComponent.vue";
import ExpenseForm from "./ExpenseForm.vue";
import {  mapMutations } from "vuex"
export default {
    components: {
        NavComponent,
        ExpenseForm
    },
    props: {
        expense: {
            type: Object
        },
        method: {
            type: String,
            required: true
        }
    },
    created(){
        this.SET_CURRENT_EXPENSE(this.expense);
        this.SET_EXPENSE_METHOD_NAME(this.method);
    },
    methods:{
        ...mapMutations(['SET_CURRENT_EXPENSE','SET_EXPENSE_METHOD_NAME'])
    },
    computed: {
        getTitle() {
            return this.method ? 'Editar Egreso' : 'Crear Egreso';
        },

    }
}
</script>
