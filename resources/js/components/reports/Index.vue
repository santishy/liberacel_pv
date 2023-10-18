<template>
    <nav-component>
        <div class="max-w-6xl mx-auto shadow  pb-4 bg-white rounded-sm px-4">
            <h1 class=" text-gray-800   py-3 text-2xl font-extralight">
                Reporte de {{ name }}
            </h1>
            <transition name="fade">
                <div v-if="total != null"
                    class=" py-3 px-4 text-green-900 font-bold text-2xl rounded-sm duration-300 transition-all bg-green-300 flex justify-end items-center">
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
        <!-- <transaction-list :uri="uri" :name="name"> </transaction-list> -->
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
            total: null
        };
    },
    mounted() {
        EventBus.$on("calculated-total", total => {
            this.total = total;
        });
        EventBus.$on("errors-found", this.errorsFound);
    },
    methods: {
        errorsFound(errors) {
            this.getErrors(errors);
        }
    }
};
</script>
