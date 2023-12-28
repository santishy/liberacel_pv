<template>
    <div class=" bg-white p-2 shadow-sm rounded-sm">
        <div class="p-1 text-center rounded-sm mb-2 bg-orange-200 text-slate-700">
            Comisiones por rango.
        </div>
        <date-picker @change="setRange" @clear="clear" placeholder="Da click para eligir el rango de fechas" :lang="lang"
            value-type="YYYY-MM-DD" v-model="dates" class="mb-2" range></date-picker>
        <div class="p-1 text-center rounded-sm mb-2 mt-2 text-xs bg-yellow-100 text-sky-500 ">
            Jueves a viernes. (Sin elegir rango)
        </div>
        <ul class="w-full">
            <li v-for="user in users" :key="user.id"
                class="bg-slate-100 rounded-sm hover:bg-slate-300 border-gray-300 w-full">
                <a href="#" @click="selectedUser(user)"
                    class="flex text-slate-500 justify-between items-center px-2 py-1 rounded-sm">
                    {{ user.name }}
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import ConfigDatePicker from "../../mixins/ConfigDatePicker.js";

export default {
    props: {
        users: {
            type: Array,
        },
    },
    data() {
        return {
            dates: null,
            range: {},
        };
    },
    components: {
        DatePicker,
    },
    mixins: [ConfigDatePicker],
    methods: {
        clear() {
            this.dates = null;
        },
        selectedUser(user) {
            this.getRange();
            EventBus.$emit("get-user-commissions", {
                user,
                ...this.range,
            });
        },
        setRange() {
            this.range = {};
            if (this.dates?.length) {
                this.range["filter[commissionsBetweenDates]"] =
                    this.dates.toString(); //convierto el array de las dos fechas de rango a un string separado por comas
            }
        },
        getRange() {
            if (!this.dates) {
                this.range = {};
                this.range["filter[ComissionsFromFridayToThursday]"] = ""; //convierto el array de las dos fechas de,
            }
        },
    },
};
</script>
<style scoped>
.mx-datepicker {
    display: block;
}

.mx-datepicker-range {
    width: 100%;
}
</style>
