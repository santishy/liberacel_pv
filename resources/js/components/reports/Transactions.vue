<template>
    <nav-component>
        <div class="w-9/12 mx-auto shadow  pb-4 bg-white rounded-sm">
            <h1
                class=" text-gray-800  text-center border-b-2 border-gray-300 py-3 text-2xl font-extralight"
            >
                Reporte de {{ name }}
            </h1>
            <transition name="fade">
                <div
                    v-if="total != null"
                    class="border-b-2 py-3 text-gray-800 border-gray-300 flex justify-center items-center"
                >
                    <span class="font-semibold text-xl ">Total:</span>
                    <div class="font-bold text-2xl ml-2">${{ total }}</div>
                </div>
            </transition>
            <errors-component :errors-found="errors"></errors-component>
            <report-by class="mt-4"></report-by>
            <warehouse-checklist :warehouses="warehouses">
            </warehouse-checklist>
        </div>
        <transaction-list :uri="uri" :name="name"> </transaction-list>
    </nav-component>
</template>
<script>

import ReportBy from "./ReportBy.vue";
import NavComponent from "../NavComponent.vue";
import ErrorsComponent from "../ErrorsComponent.vue";
import WarehouseChecklist from "../warehouses/WarehouseChecklist.vue"

export default {
    components: { ReportBy, NavComponent ,ErrorsComponent,WarehouseChecklist},
    props: {
        name: {
            type: String
        },
        uri:{
            type:String
        },
        warehouses: {
            type:Array
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
        EventBus.$on("errors-found",this.errorsFound);
    },
    methods:{
        errorsFound(errors){
            console.log('entro a los errors')
            this.getErrors(errors);
        }
    }
};
</script>
