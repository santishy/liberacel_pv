<template>
    <div class="shadow-sm bg-white">
        <table class="table-auto w-full">
            <thead class="bg-blue-700">
                <tr class="text-white font-extralight">
                    <th class="px-1 py-2">FECHA CREDITO</th>
                    <th class="px-1 py-2">ClIENTE</th>
                    <th class="px-1 py-2">NUMERO TEL.</th>
                    <th class="px-1 py-2">MONTO PAGADO</th>
                    <th class="px-1 py-2">TOTAL</th>
                    <th class="px-1 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <credit-list-item v-for="(credit, index) in credits" :key="credit.id" :credit="credit" :index="index">
                </credit-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="getCredits"></infinite-loading>
    </div>
</template>
<script>
import CreditListItem from './CreditListItem.vue';
export default {
    data() {
        return {
            credits: [],
            page: 1,

        };
    },
    components: {
        CreditListItem,
    },
    created() {
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
            this.credits[index].total_amount_formatted = this.formattedCurrency.format(this.credits[index].total_amount)
            this.credits[index].formatted_amount_paid = this.formattedCurrency.format(this.credits[index].amount_paid)
            console.log(this.credits[index]);
        })
    },
    methods: {
        getCredits($state) {
            axios
                .get("/credits", {
                    params: {
                        page: this.page,
                        "filter[withStatus]": "pending",
                    }
                },)
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
        findIndexById(id) {
            return this.credits.findIndex((credit) => credit.id === id);
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
