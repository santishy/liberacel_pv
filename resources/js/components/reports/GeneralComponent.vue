<template>
    <div v-show="show" class="flex flex-wrap flex-col gap-4">
        <div @scroll="handleScroll" id="payments-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <div class="bg-white mb-1 rounded border border-yellow-300 shadow p-1 pl-2 font-mono text-xl text-slate-700">
                Pagos
            </div>
            <payment-list :first-load="payments" :uri="URIs[0]"></payment-list>
        </div>
        <div @scroll="handleScroll" id="sales-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <div class="bg-white mb-1 rounded border border-yellow-300 shadow p-1 pl-2 font-mono text-xl text-slate-700">
                Ventas
                Stock</div>
            <transaction-list name="Ventas" :first-load="sales" :uri="URIs[2]"></transaction-list>
        </div>
        <div @scroll="handleScroll" id="fast-sales-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <div class="bg-white mb-1 rounded border border-yellow-300 shadow p-1 pl-2 font-mono text-xl text-slate-700">
                Ventas
                Expres</div>
            <list-of-products-sold :first-load="fastSales" :uri="URIs[3]"></list-of-products-sold>
        </div>
        <div @scroll="handleScroll" id="expenses-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <div class="bg-white mb-1 rounded border border-yellow-300 shadow p-1 pl-2 font-mono text-xl text-slate-700">
                Egresos
            </div>
            <expense-list :first-load="expenses" :uri="URIs[1]"></expense-list>
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
        handleScroll(event) {
            if (Math.ceil(event.srcElement.offsetHeight + event.srcElement.scrollTop) >= event.srcElement.scrollHeight) {
                switch (event.target.id) {
                    case "sales-container":
                        this.sales = []
                        break;
                    case "fast-sales-container":
                        this.fastSales = []
                        break;
                    case "expenses-container":
                        this.expenses = []
                        break;
                    case "payments-container":
                        this.payments = []
                        break;
                    default:
                        console.error("ID not found");
                }
            }
        },
        async getReports(params) {
            this.show = false;
            const reports = this.URIs.map(
                uri => {
                    if (uri === '/expenses/') {
                        delete params['filter[status]']
                    }
                    if (uri === '/payments/') {
                        params['filter[status]'] = 1;
                    }
                    if (uri === '/fast-sales/') {
                        params = _.merge({ include: "user", isFastSale: true, "filter[isCredit]": false, "filter[status]": "completed" }, params)
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
                console.log({ fastSales: this.fastSales })
                this.show = true;
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>
