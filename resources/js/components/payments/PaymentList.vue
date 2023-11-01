<template>
    <div class="table-container-responsive">
        <table class="report-table">
            <thead class="report-table-thead">
                <tr class="bg-green-200">
                    <th class="py-2 px-2 ">Fecha</th>
                    <th class="px-2 py-2">Monto</th>
                    <th class="px-2 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <payment-list-item v-for="(payment, index) in payments" :payment="payment" :index="index" :key="payment.id">
                </payment-list-item>
            </tbody>
            <infinite-loading @infinite="infiniteHandler" :identifier="infiniteId"></infinite-loading>
        </table>
    </div>
</template>
<script>
import PaymentListItem from "./PaymentListItem.vue";
export default {
    components: {
        PaymentListItem,
    },
    props: {
        credit: {
            type: Object,
            default: () => { }
        },
        index: {
            type: Number,
            default: null
        }
    },
    created() {
        EventBus.$on('updated-payment', res => {
            const { index, data } = res;
            if (index >= 0) {
                if (!data.payment.status) {

                    this.payments.splice(index, 1);
                    return;
                }
                Vue.set(this.payments, index, data.payment)
            }
        });

    },
    data() {
        return {
            payments: [],
            page: 1,
            //params:null,
            infiniteId: 1
        };
    },
    methods: {
        infiniteHandler($state) {
            axios
                .get(`/credit/${this.credit.id}/payments`, {
                    params: {
                        page: this.page,
                        "filter[status]": true
                    }
                })
                .then(res => {
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.payments.length) {
                        this.page += 1;
                        this.payments.push(...res.data.payments);
                        $state.loaded()
                    } else {
                        $state.complete();
                    }
                });
        },
        changeParams() {
            // this.params = value;
            this.page = 1;
            this.payments = [];
            this.infiniteId += 1;
        },
    },
    watch: {
        credit: {
            handler(newCredit, oldCredit) {

                if (newCredit.id != oldCredit.id) {
                    this.changeParams();
                }

            },
            deep: true
        }
    }
};
</script>
