<template>
    <div
        class="relative overflow-x-auto bg-white scroll-smooth scrollbar-track-transparent  scrollbar-thumb-sky-700 scrollbar-thin">
        <table class="w-full text-sm text-left text-slate-500 ">
            <thead class=" text-slate-700 uppercase bg-slate-100">
                <tr>
                    <th class="px-2 py-2">FECHA CREDITO</th>
                    <th class="px-2 py-2">Status</th>
                    <th class="px-2 py-2">ClIENTE</th>
                    <th class="px-2 py-2">NUMERO TEL.</th>
                    <th class="px-2 py-2">MONTO PAGADO</th>
                    <th class="px-2 py-2">TOTAL</th>
                    <th class="px-2 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <credit-list-item v-for="(credit, index) in credits" :key="credit.id" :credit="credit" :index="index">
                </credit-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="getCredits" :identifier="infiniteId"></infinite-loading>
    </div>
</template>
<script>
import CreditListItem from './CreditListItem.vue';
export default {
    data() {
        return {
            credits: [],
            page: 1,
            infiniteId: 1,
            params: {
                "filter[withStatus]": "pending",
            }
        };
    },
    components: {
        CreditListItem,
    },
    created() {
        EventBus.$on('updated-payment', this.updateCreditList)
        EventBus.$on("filter-credits", this.changeParams)
        EventBus.$on('fetch-client-credit', (data) => {
            if (data?.data) {
                data = data.data
            }
            this.credits = data;
        });
        EventBus.$on('credit-removed', (index) => {
            if (index) {
                this.credits.splice(index, 1);
            }
        });
        EventBus.$on('saved-payment', (credit) => {
            const index = this.findIndexById(credit.id);
            if (index === -1) {
                throw new Error('The element was not found in the array.')
            }
            this.credits[index].total_amount = credit.total_amount;
            this.credits[index].amount_paid = credit.amount_paid;
            this.credits[index].status = credit.status;
            this.credits[index].total_amount_formatted = this.formattedCurrency.format(this.credits[index].total_amount)
            this.credits[index].formatted_amount_paid = this.formattedCurrency.format(this.credits[index].amount_paid)
        })
    },
    methods: {
        getCredits($state) {
            axios
                .get("/credits", {
                    params: {
                        page: this.page,
                        ...this.params
                    }
                })
                .then((res) => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.credits.push(...res.data.data);
                        $state.loaded();
                    }
                    else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.credits = [];
            this.infiniteId += 1;
        },
        findIndexById(id) {
            return this.credits.findIndex((credit) => credit.id === id);
        },
        updateCreditList(res) {
            const { data } = res;
            if (data) {
                const index = this.findIndexById(data.payment.credit_id)
                if (index != -1) {
                    const credit = this.credits[index];
                    /**
             *  aqui hago ...this.credit, para q m conserve el cliente y no volverlo a cargar
             * */
                    Vue.set(this.credits, index, {
                        ...credit,
                        ...data.payment.credit
                    })
                }
            } else {
                throw new Error("data object does not exist.")
            }
        }
    },
    computed: {
        formattedCurrency() {
            return new Intl.NumberFormat("mx-MX", {
                style: "currency",
                currency: "MXN",
            })
        }
    }
};

</script>
