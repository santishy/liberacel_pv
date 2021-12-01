<template>
    <div class="flex flex-wrap flex-col items-center justify-center">
        <toggle-component class="col-span-1 mr-2 mb-4"></toggle-component>
        <div class="flex justify-center flex-wrap items-center">
            <div class="p-1 border bg-purple-600 rounded text-white px-3 mr-2">
                <span>Reporte por rango</span>
                <date-picker
                    @change="getReport(range, 'betweenDates')"
                    placeholder="Da click para eligir el rango de fechas"
                    :lang="lang"
                    value-type="YYYY-MM-DD"
                    v-model="dates"
                    range
                ></date-picker>
            </div>
            <div>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2"
                    @click.prevent="getReport(today)"
                >
                    Hoy
                </button>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2"
                    href="#"
                    @click.prevent="getReport(week)"
                >
                    Semana
                </button>
                <button
                    class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 rounded px-4 py-2"
                    href="#"
                    @click.prevent="getReport(month)"
                >
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
