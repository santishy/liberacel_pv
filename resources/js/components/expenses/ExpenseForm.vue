<template>
    <form @submit.prevent="submit" class="bg-white shadow-sm p-2 rounded-sm w-full md:w-10/12 space-y-2">
        <div class="w-full flex">
            <label
                class="w-3/12 text-center text-gray-700 font-serif font-semibold mr-2 rounded-sm py-3 px-6">Concepto</label>
            <input type="text" name="concept" v-model="form.concept"
                class="placeholder:italic font-font-light placeholder-gray-500 placeholder-shown:border-gray-500 appearance-none bg-gray-300 rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                placeholder="Concepto ejemplo: Trapeador para realizar aseo" autocomplete="off" />
        </div>
        <div class="w-full flex">
            <label
                class="w-3/12 text-center text-gray-700 font-serif font-semibold mr-2 rounded-sm py-3 px-6">Monto</label>
            <input type="text" name="amount" v-model="form.amount"
                class="placeholder:italic font-font-light placeholder-gray-500 placeholder-shown:border-gray-500 appearance-none bg-gray-300 rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                placeholder="Precio" autocomplete="off" />
        </div>
        <div class="flex items-center w-full justify-center">
            <errors-component class="w-6/12" :errors-found="errors" />
        </div>
        <div class="w-full flex justify-center">
            <button
                class="w-6/12 p-2 text-white bg-blue-400 font-bold font-mono  rounded-sm shadow-sm hover:bg-blue-600 hover:text-gray-900">Guardar</button>
        </div>
    </form>
</template>

<script>
import { mapState } from 'vuex';
export default {

    data() {
        return {
            form: {},
            uri:'/expenses/'
        };
    },
    created(){
        if(this.currentExpense){
            this.form = this.currentExpense;
        }
    },
    methods: {
        submit() {
            if (this.expenseMethodName.toUpperCase() === 'PATCH') {
                this.form._method = 'PATCH';
                this.uri = this.uri + this.currentExpense.id;
            }
            axios.post(this.uri, this.form)
                .then(res => {
                    if (res.data.data) {
                        this.notify({
                            title: "Egresos",
                            message: this.getNotificationText,
                        });
                        if(this.expenseMethodName.toUpperCase() === 'POST')
                            this.form = {}
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.getErrors(err);
                });
        }
    },
    computed:{
        ...mapState(["expenseMethodName","currentExpense"]),
        getNotificationText(){
            if(this.expenseMethodName.toUpperCase() === 'POST'){
                return 'Egreso agregado';
            }
            else{
                return 'Egreso modificado';
            }
        }
    }
};
</script>
