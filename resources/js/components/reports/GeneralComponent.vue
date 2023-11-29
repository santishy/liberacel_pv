<template>
    <div v-show="show" class="flex flex-wrap flex-col gap-2">
        <div class="bg-white w-full md:w-4/12 rounded border border-sky-300  p-1 pl-2 font-mono text-xl text-sky-500">
            Pagos
        </div>
        <div @scroll="handleScroll" id="payments-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <payment-list :first-load="payments" :uri="URIs[0]"></payment-list>
        </div>
        <div class="bg-white w-full md:w-4/12 rounded border border-sky-300  p-1 pl-2 font-mono text-xl text-sky-500">
            Ventas
            Stock</div>
        <div @scroll="handleScroll" id="sales-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <transaction-list name="Ventas" :first-load="sales" :uri="URIs[2]"></transaction-list>
        </div>
        <div class="bg-white w-full md:w-4/12 rounded border border-sky-300  p-1 pl-2 font-mono text-xl text-sky-500">
            Ventas
            Expres</div>
        <div @scroll="handleScroll" id="fast-sales-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <list-of-products-sold :first-load="fastSales" :uri="URIs[3]"></list-of-products-sold>
        </div>
        <div class="bg-white w-full md:w-4/12 rounded border border-sky-300  p-1 pl-2 font-mono text-xl text-sky-500">
            Egresos
        </div>
        <div @scroll="handleScroll" id="expenses-container"
            class="p-4 max-h-56 overflow-y-auto bg-slate-50 shadow-inner rounded-sm">
            <expense-list :first-load="expenses" :uri="URIs[1]"></expense-list>
        </div>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'

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
        this.SET_IS_IN_GENERAL_REPORT(true);
    },
    methods: {
        ...mapMutations(["SET_IS_IN_GENERAL_REPORT"]),
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
                    return axios.get(uri + '?page=1', { params })
                }
            );
            try {
                const [
                    { data: { data: paymentsData, total: paymentsTotal } },
                    { data: { data: expensesData, total: expensesTotal } },
                    { data: { data: salesData, rawTotal: salesTotal } },
                    { data: { data: fastSalesData, rawTotal: fastSalesTotal } }
                ] = await Promise.all(reports);
                this.payments = paymentsData;
                this.expenses = expensesData;
                this.sales = salesData
                this.fastSales = fastSalesData;
                EventBus.$emit(
                    'calculate-overall-report-total',
                    {
                        paymentsTotal, fastSalesTotal, expensesTotal, salesTotal
                    }
                )
                this.show = true;
            } catch (err) {
                console.log(err);
            }
        }
    }
}
</script>
