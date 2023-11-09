<template>
    <div class="flex flex-wrap flex-col gap-4">
        <div class="payment-container max-h-56 overflow-hidden">
            <div class="font-mono text-xl text-slate-600">Pagos</div>
            <payment-list :uri="URIs[0]"></payment-list>
        </div>
        <div class="sales-container max-h-56 overflow-hidden">
            <div class="font-mono text-xl text-slate-600">Ventas Stock</div>
            <transaction-list name="Ventas" :uri="URIs[2]"></transaction-list>
        </div>
        <div class="express-sales-container max-h-56 overflow-hidden">
            <div class="font-mono text-xl text-slate-600">Ventas Expres</div>
            <list-of-products-sold :uri="URIs[3]"></list-of-products-sold>
        </div>
        <div class="expenditure-container max-h-56 overflow-hidden">
            <div class="font-mono text-xl text-slate-600">Egresos</div>
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
            ]
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
            const data = await Promise.all(reports);
            console.log({ data })
        }
    }
}
</script>
