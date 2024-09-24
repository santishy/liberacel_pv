<template>
    <div class="relative overflow-x-auto bg-white">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class=" text-slate-700 uppercase bg-slate-100">
                <tr>
                    <th class="px-2 py-2">FECHA</th>
                    <th class="px-2 py-2">CONCEPTO</th>
                    <th class="px-2 py-2">IMPORTE</th>
                    <th class="px-2 py-2">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <expense-list-item v-for="(expense, index) in expenses" :key="expense.id" :expense="expense"
                    :index="index">
                </expense-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="getExpenses"></infinite-loading>
    </div>
</template>

<script>
import ExpenseListItem from "./ExpenseListItem.vue";
export default {
    components: {
        ExpenseListItem,
    },
    data() {
        return {
            expenses: [],
            page: 1,
        };
    },
    created() {
        EventBus.$on('expense-removed', (index) => {
            if (index) {
                this.expenses.splice(index, 1);
            }
        })
    },
    methods: {
        getExpenses($state) {
            axios
                .get("/expenses", {
                    params: {
                        page: this.page,
                    }
                },)
                .then((res) => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.expenses.push(...res.data.data);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>
