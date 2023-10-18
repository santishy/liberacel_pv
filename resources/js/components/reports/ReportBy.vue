<template>
    <div class="flex flex-wrap flex-col items-start justify-start">
        <toggle-component class="col-span-1 mr-2 mb-4"></toggle-component>
        <div class="flex justify-center flex-wrap items-center w-full">
            <div class="w-full flex flex-wrap justify-center gap-4  ">
                <div class="p-1 border bg-sky-300 rounded text-slate-700 font-semibold px-3">
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
import ToggleComponent from "./ToggleComponent.vue";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import ConfigDatePicker from "../../mixins/ConfigDatePicker.js";
export default {
    components: {
        ToggleComponent,
        DatePicker
    },
    mixins: [ConfigDatePicker],
    created() {
        EventBus.$on("status-filter-cancelled", status => {
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
    }
};
</script>
