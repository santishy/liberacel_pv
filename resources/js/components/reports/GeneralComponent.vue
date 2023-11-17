<template>
    <div v-if="show" class="flex flex-wrap flex-col gap-4">
        <div class=" p-2 max-h-56 overflow-y-hidden">
            <div class="bg-yellow-300 rounded-sm shadow-sm mb-2 p-2 font-mono text-xl text-slate-700">Pagos</div>
            <payment-list :first-load="payments" :is-in-general-report="true" :uri="URIs[0]"></payment-list>
        </div>
        <div class="p-2 max-h-56 overflow-hidden">
            <div class="bg-yellow-300 rounded-sm shadow-sm mb-2 p-2 font-mono text-xl text-slate-700">Ventas Stock</div>
            <transaction-list name="Ventas" :uri="URIs[2]"></transaction-list>
        </div>
        <div class="p-2 max-h-56 overflow-hidden">
            <div class="bg-yellow-300 rounded-sm shadow-sm mb-2 p-2 font-mono text-xl text-slate-700">Ventas Expres</div>
            <list-of-products-sold :uri="URIs[3]"></list-of-products-sold>
        </div>
        <div class=" p-2 expenditure-container max-h-56 overflow-hidden">
            <div class="bg-yellow-300 rounded-sm shadow-sm mb-2 p-2 font-mono text-xl text-slate-700">Egresos</div>
            <expense-list :uri="URIs[1]"></expense-list>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            URIs: [
                '/payments/',
                '/expenses/',
                '/sales/',
                '/fast-sales/'
            ],
            expenses: [],
            payments: [],
            sales: [],
            fastSales: [],
            show: false
        }
    },
    created() {
        EventBus.$on('set-parameters', this.getReports)
    },
    methods: {
        async getReports(params) {
            const reports = this.URIs.map(
                uri => {
                    if (uri === '/expenses/') {
                        delete params['filter[status]']
                    }
                    if (uri === '/payments/') {
                        params['filter[status]'] = 1;
                    }
                    return axios.get(uri, { params })
                }
            );
            try {
                const [payments, expenses, sales, fastSales] = await Promise.all(reports);
                this.payments = payments.data.data;
                this.expenses = expenses.data.data;
                this.sales = sales.data.data;
                this.fastSales = fastSales.data.data;
                this.show = true;
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>
