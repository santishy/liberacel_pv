<template>
    <div>
        <date-picker
            @change="setRange"
            placeholder="Da click para eligir el rango de fechas"
            :lang="lang"
            value-type="YYYY-MM-DD"
            v-model="dates"
            range
        ></date-picker>
        <ul class="w-full">
            <li
                v-for="user in users"
                :key="user.id"
                class="bg-white border border-gray-300"
            >
                <a
                    href="#"
                    @click="getCommissions(user.id)"
                    class="flex justify-between items-center px-2 py-3"
                >
                    {{ user.name }}
                    <span
                        class="
                            rounded-lg
                            text-sm
                            py-1
                            px-2
                            bg-yellow-400
                            text-gray-800
                        "
                        >{{ user.username }}</span
                    >
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
           /*  statusFilter: {
                "filter[completedStatus]": "completed",
            }, */
        };
    },
    components: {
        DatePicker,
    },
    mixins: [ConfigDatePicker],
    methods: {
        getCommissions(user_id){
            this.getRange();
            EventBus.$emit('commissions-earned',{user_id,...this.range})
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
                this.range["filter[weeklyCommissions]"] = ""; //convierto el array de las dos fechas de,
            }
        },
    },
};
</script>
