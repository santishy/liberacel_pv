<template>
    <nav-component>
        <div class="max-w-6xl mx-auto shadow  pb-4 bg-white rounded-sm px-4">
            <h1 class=" text-gray-800   py-3 text-2xl font-extralight">
                Reporte de {{ name }}
            </h1>
            <div class="w-full flex justify-end">
                <ul class=" divide-y-2 flex flex-wrap flex-col md:w-60  ">
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2"><span
                            class="text-xl font-mono text-slate-700">Ventas</span>
                        <span class="font-semibold">{{ salesTotal }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2"><span
                            class="text-xl font-mono text-slate-700">Expres</span>
                        <span class="font-semibold">{{ fastSalesTotal }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2"><span
                            class="text-xl font-mono text-slate-700">Pagos</span>
                        <span class="font-semibold">{{ paymentsTotal }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-red-500 rounded-sm p-1 px-2"><span
                            class="text-xl font-mono text-slate-700">Egresos</span>
                        <span class="font-semibold">{{ expensesTotal }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center bg-sky-200 text-slate-700 rounded-sm p-1 px-2">
                        <span class="text-xl font-mono text-slate-700">Total</span>
                        <span class="font-bold">{{ getTotal }}</span>
                    </li>
                </ul>
                <div>

                </div>
            </div>
            <transition name="fade">
                <div v-if="total != null"
                    class=" py-3 px-4 text-green-900 font-bold text-2xl rounded-sm duration-300 transition-all bg-green-200 flex justify-end items-center">
                    <span class="font-semibold text-xl ">Total:</span>
                    <div class="font-bold text-2xl ml-2">${{ total }}</div>
                </div>
            </transition>
            <errors-component :errors-found="errors"></errors-component>
            <report-by class="mt-4"></report-by>
            <warehouse-checklist :warehouses="warehouses">
            </warehouse-checklist>
        </div>
        <div class="mt-4 max-w-6xl mx-auto">
            <slot></slot>
        </div>
    </nav-component>
</template>
<script>

import ReportBy from "./ReportBy.vue";
import NavComponent from "../NavComponent.vue";
import ErrorsComponent from "../ErrorsComponent.vue";
import WarehouseChecklist from "../warehouses/WarehouseChecklist.vue"

export default {
    components: { ReportBy, NavComponent, ErrorsComponent, WarehouseChecklist },
    props: {
        name: {
            type: String
        },
        uri: {
            type: String
        },
        warehouses: {
            type: Array
        }
    },
    data() {
        return {
            total: null,
            fastSalesTotal: null,
            expensesTotal: null,
            salesTotal: null,
            paymentsTotal: null
        };
    },
    mounted() {
        EventBus.$on("calculated-total", (total) => {
            this.total = total;
        });
        EventBus.$on("calculate-overall-report-total", totals => {
            this.fastSalesTotal = totals.fastSalesTotal;
            this.salesTotal = totals.salesTotal;
            this.expensesTotal = totals.expensesTotal;
            this.paymentsTotal = totals.paymentsTotal;
        })
        EventBus.$on("errors-found", this.errorsFound);
    },
    methods: {
        errorsFound(errors) {
            this.getErrors(errors);
        },
        formattedNumber(amount) {
            amount.toLocaleString('es-MX', {
                style: 'currency',
                currency: 'MXN'
            });
        }
    },
    computed: {
        getTotal() {
            return this.formattedNumber((this.fastSalesTotal + this.salesTotal + this.paymentsTotal));
        }
    }
};
</script>
