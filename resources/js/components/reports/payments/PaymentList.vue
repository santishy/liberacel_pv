<template>
    <div class="table-container-responsive">
        <table v-if="params" class="report-table">
            <thead class="report-table-responsive">
                <tr class="bg-green-200">
                    <th class="py-2 px-2">Fecha</th>
                    <th class="py-2 px-2">ID Credito</th>
                    <th class="py-2 px-2">Monto</th>
                    <th class="py-2 px-2">Cliente</th>
                    <th class="py-2 px-2">Monto Pagado</th>
                    <th class="py-2 px-2">Saldo</th>
                    <th class="py-2 px-2">Acciones</th>
                </tr>
            </thead>
            <transition-group name="bounce" tag="tbody" @after-leave="afterLeave">
                <payment-list-item v-for="(payment, index) in payments" :payment="payment" :index="index" :key="payment.id">
                </payment-list-item>
            </transition-group>
            <infinite-loading v-if="!firstLoad.length" @infinite="infiniteHandler" :identifier="infiniteId"
                ref="infiniteLoading"></infinite-loading>
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
        name: {
            type: String
        },
        uri: {
            type: String
        },
        firstLoad: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            payments: [],
            page: 1,
            params: null,
            searchTheWarehouses: {
                "filter[byWarehouses]": null
            },
            infiniteId: 1,

        };
    },
    mounted() {
        EventBus.$on("set-parameters", data => {
            this.changeParams(data);
        });

        EventBus.$on("selected-warehouses", warehouses => {
            this.searchTheWarehouses[
                "filter[byWarehouses]"
            ] = warehouses.toString();
        });
    },
    watch: {
        firstLoad: {
            handler(newValue, oldValue) {
                if (!Array.isArray(newValue)) {
                    throw new Error("It is not an array")
                }
                if (!newValue.length) {
                    return;
                }
                this.payments = newValue;
                this.page = 2;
            },
            deep: true
        }
    },
    methods: {
        infiniteHandler($state) {
            this.params = {
                ...this.params,
                "filter[status]": 1,
            }
            axios
                .get(this.uri, {
                    params: {
                        page: this.page,
                        ..._.merge(this.params, this.getRelationships),
                        ...this.searchTheWarehouses
                    }
                })
                .then(res => {
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.data.length) {
                        this.page += 1;
                        this.payments.push(...res.data.data);
                        $state.loaded()
                    } else {
                        $state.complete();
                    }
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.payments = [];
            this.infiniteId += 1;
        },
        afterLeave() {
            this.$nextTick(() => {
                if (!this.$refs?.infiniteLoading?.status) {
                    this.$refs?.infiniteLoading?.stateChanger?.reset();
                }
            });
        },
    },
};
</script>
