<template>
    <layout-component>
        <div class="w-full  flex flex-wrap flex-col items-center  justify-center">
            <expense-form :title="getTitle" />
        </div>
    </layout-component>
</template>

<script>
//import NavComponent from "../NavComponent.vue";
import ExpenseForm from "./ExpenseForm.vue";
import { mapMutations } from "vuex"
export default {
    components: {
        //      NavComponent,
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
    created() {
        this.SET_CURRENT_EXPENSE(this.expense);
        this.SET_EXPENSE_METHOD_NAME(this.method);
    },
    methods: {
        ...mapMutations(['SET_CURRENT_EXPENSE', 'SET_EXPENSE_METHOD_NAME'])
    },
    computed: {
        getTitle() {
            if (this.method === 'POST')
                return 'Crear Egreso';
            return 'Editar Egreso';
        },

    }
}
</script>
