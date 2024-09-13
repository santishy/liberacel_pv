<template>
    <layout-component>
        <div class="max-w-6xl mx-auto shadow  pb-4 bg-white rounded-sm px-4">
            <h1 class=" text-gray-700 border-b-2 border-sky-500  py-3 text-2xl font-extralight">
                Reporte de {{ name }}
            </h1>
            <div v-if="isInGeneralReport" class="w-full mt-4 flex justify-start items-center">
                <ul v-if="paymentsTotal != null" class=" divide-y-2 flex flex-wrap flex-col w-full">
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2">
                        <span class="text-xl font-mono text-slate-600 mr-4">Ventas</span>
                        <span class="font-semibold flex flex-wrap items-center">
                            <svg fill="none" class="h-4 w-4" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            {{ formattedNumber(salesTotal) }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2">
                        <span class="text-xl font-mono text-slate-600 mr-4">Expres</span>
                        <span class="font-semibold flex flex-wrap items-center">
                            <svg fill="none" class="h-4 w-4" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            {{ formattedNumber(fastSalesTotal) }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-green-600 rounded-sm p-1 px-2"><span
                            class="text-xl font-mono text-slate-600 mr-4">Pagos</span>
                        <span class="font-semibold flex flex-wrap items-center">
                            <svg fill="none" class="h-4 w-4" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                            </svg>
                            {{ formattedNumber(paymentsTotal) }}</span>
                    </li>
                    <li class="flex flex-wrap justify-between items-center text-red-500 rounded-sm p-1 px-2">
                        <span class="text-xl font-mono text-slate-600 mr-4">Egresos</span>
                        <span class="font-semibold flex flex-wrap items-center">
                            <svg fill="none" class="h-4 w-4" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
                            </svg>
                            {{ formattedNumber(expensesTotal) }}</span>
                    </li>
                    <li
                        class="flex flex-wrap justify-end items-center bg-yellow-400 text-slate-700 rounded-sm p-1 px-2">
                        <span class="text-xl mr-4 font-semibold text-slate-800">Total</span>
                        <span class="font-bold text-slate-900">{{ getTotal }}</span>
                    </li>
                </ul>
            </div>
            <transition v-else name="fade">
                <div v-if="total != null"
                    class=" py-2 mt-4 px-4 text-green-900 font-bold text-2xl rounded-sm duration-300 transition-all bg-yellow-400 flex justify-end items-center">
                    <span class="font-semibold text-xl ">Total:</span>
                    <div class="font-bold text-2xl ml-2">${{ total }}</div>
                </div>
            </transition>
            <errors-component />
            <report-by class="mt-4">
                <template v-if="isSale" #search>
                    <search-by-id :uri="uri"></search-by-id>
                </template>
            </report-by>
            <warehouse-checklist :warehouses="warehouses">
            </warehouse-checklist>
        </div>
        <div class="mt-4 max-w-6xl mx-auto">
            <slot></slot>
        </div>
    </layout-component>
</template>
<script>
import { mapState } from "vuex";
import ReportBy from "./ReportBy.vue";
//import NavComponent from "../NavComponent.vue";
import SearchById from "./partials/SearchById.vue";
import ErrorsComponent from "../ErrorsComponent.vue";
import WarehouseChecklist from "../warehouses/WarehouseChecklist.vue"

export default {
    components: { ReportBy, SearchById, ErrorsComponent, WarehouseChecklist },
    props: {
        name: {
            type: String
        },
        isSale: {
            type: Boolean,
            default: false
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
            paymentsTotal: null,

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
            EventBus.$emit('an-error-ocurred', errors);
            //this.getErrors(errors);
        },
        formattedNumber(amount) {
            if (!amount) return 0;
            return amount.toLocaleString('es-MX', {
                style: 'currency',
                currency: 'MXN'
            });
        }
    },
    computed: {
        ...mapState(["isInGeneralReport"]),
        getTotal() {
            return this.formattedNumber((parseFloat(this.fastSalesTotal) + parseFloat(this.salesTotal) + parseFloat(this.paymentsTotal)) - parseFloat(this.expensesTotal))
        }
    }
};
</script>
