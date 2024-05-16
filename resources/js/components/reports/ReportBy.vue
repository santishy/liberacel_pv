<template>
    <div class="flex flex-wrap flex-col items-start justify-start">
        <!-- <toggle-component v-if="!isInGeneralReport" class="col-span-1 mr-2 mb-4"></toggle-component> -->
        <div class="flex justify-start gap-4 flex-wrap items-center w-full mt-4">
            <states-component v-if="!isInGeneralReport" />
            <div class="grow">
                <slot name="search"></slot>
            </div>
            <div class="w-full flex flex-wrap justify-start gap-4 mt-4 ">
                <div class="p-1 border bg-orange-100 flex-grow rounded text-slate-700 font-mono px-3">
                    <span>Reporte por rango</span>
                    <date-picker @change="getReport(range, 'betweenDates')"
                        placeholder="Da click para eligir el rango de fechas" :lang="lang" value-type="YYYY-MM-DD"
                        v-model="dates" range></date-picker>
                </div>
                <button class="report-button px-4 py-2" @click.prevent="getReport(today)">
                    Hoy
                </button>
                <button class="report-button px-4 py-2" href="#" @click.prevent="getReport(fridayToThursday)">
                    Viernes a Jueves
                </button>
                <button class="report-button px-4 py-2" href="#" @click.prevent="getReport(week)">
                    Semana
                </button>
                <button class="px-4 py-2 report-button" href="#" @click.prevent="getReport(month)">
                    Mes
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import ConfigDatePicker from "../../mixins/ConfigDatePicker.js";
//import ToggleComponent from "./ToggleComponent.vue";
import SearchById from "./partials/SearchById.vue";
import StatesComponent from "./partials/StatesComponent.vue";
export default {
    components: {
        //    ToggleComponent,
        StatesComponent,
        DatePicker,
        SearchById
    },
    mixins: [ConfigDatePicker],
    created() {
        EventBus.$on("status-filter-cancelled", status => {
            this.status["filter[status]"] = status;
        });
        EventBus.$on("changed-status", status => {
            this.status["filter[status]"] = status;
        });
    },
    data() {
        return {
            range: {
                "filter[betweenDates]": []
            },
            today: {
                "filter[today]": ""
            },
            week: {
                "filter[week]": ""
            },
            month: {
                "filter[currentMonth]": ""
            },
            fridayToThursday: {
                "filter[fridayToThursday]": ""
            },
            status: { "filter[status]": "completed" },
            dates: null
        };
    },
    methods: {
        getReport(value, reportBy = "") {
            if (reportBy === "betweenDates") {
                if (this.dates?.length) {
                    this.range["filter[betweenDates]"] = this.dates.toString(); //convierto el array de las dos fechas de rango a un string separado por comas
                }
            }
            EventBus.$emit("set-parameters", _.merge(value, this.status)); //._merge conbina dos json
        }
    },
    computed: {
        ...mapState(["isInGeneralReport"])
    }
};
</script>
