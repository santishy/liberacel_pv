<template>
    <form @submit.prevent="submit" class="bg-white shadow-sm p-4 rounded-sm w-full md:max-w-2xl space-y-4">
        <h1 class="py-1 font-semibold text-2xl">{{ title }}</h1>
        <errors-component />
        <div class="">
            <label class="form-label">Concepto</label>
            <textarea type="text" rows="3" name="concept" v-model="form.concept" class="form-text-input w-full"
                placeholder="Concepto ejemplo: Trapeador para realizar aseo" autocomplete="off" />
        </div>
        <div class="">
            <label class="form-label">Monto</label>
            <input type="text" name="amount" v-model="form.amount" class="form-text-input w-full" placeholder="Precio"
                autocomplete="off" />
        </div>

        <div class="">
            <button class="primary-button sm:w-auto w-full">Guardar</button>
        </div>
    </form>
</template>

<script>
import { mapState } from 'vuex';
export default {
    props: ['title'],
    data() {
        return {
            form: {},
            uri: '/expenses'
        };
    },
    created() {
        if (this.currentExpense) {
            this.form = this.currentExpense;
        }
    },
    methods: {
        submit() {
            if (this.expenseMethodName.toUpperCase() === 'PATCH') {
                if (this.form._method != "PATCH") {
                    this.form._method = 'PATCH';
                    this.uri = this.uri + `/${this.currentExpense.id}`;
                }
            }
            axios.post(this.uri, this.form)
                .then(res => {
                    if (res.data.data) {
                        this.notify({
                            title: "Egresos",
                            message: this.getNotificationText,
                        });
                        if (this.expenseMethodName.toUpperCase() === 'POST')
                            this.form = {}
                    }
                })
                .catch(err => {
                    console.log("...")
                    EventBus.$emit('an-error-ocurred', err);
                });
        }
    },
    computed: {
        ...mapState(["expenseMethodName", "currentExpense"]),
        getNotificationText() {
            if (this.expenseMethodName.toUpperCase() === 'POST') {
                return 'Egreso agregado';
            }
            else {
                return 'Egreso modificado';
            }
        }
    }
};
</script>
