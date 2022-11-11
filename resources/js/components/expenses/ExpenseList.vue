<template>
    <div class="shadow-sm bg-white">
        <table class="table-auto w-full">
            <thead class="bg-blue-700">
                <tr class="text-white font-extralight">
                    <th class="px-1 py-2">FECHA</th>
                    <th class="px-1 py-2">CONCEPTO</th>
                    <th class="px-1 py-2">IMPORTE</th>
                    <th class="px-1 py-2">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <expense-list-item v-for="(expense, index) in expenses" :key="expense.id" :expense="expense" :index="index">
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
                    else{
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
