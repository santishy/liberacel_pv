<template>
    <div class="container w-full mx-auto mt-4 flex justify-center">
        <table v-if="params" class="table-auto bg-white  text-center w-full">
            <thead>
                <tr class="bg-purple-200">
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">ID Credito</th>
                    <th class="px-4 py-2">Monto</th>
                    <th class="px-4 py-2">Cliente</th>
                    <th class="px-4 py-2">Monto Pagado</th>
                    <th class="px-4 py-2">Saldo</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>

            <transition-group name="bounce" tag="tbody" @after-leave="afterLeave">
                <payment-list-item v-for="(payment, index) in payments" :payment="payment" :index="index" :key="payment.id"
                    :uri="uri">
                </payment-list-item>
            </transition-group>
            <infinite-loading @infinite="infiniteHandler" :identifier="infiniteId" ref="infiniteLoading"></infinite-loading>
        </table>
    </div>
</template>
<script>

import Message from "../../alerts/Message.vue";
import Agree from "../../alerts/Agree.vue";
import PaymentListItem from "./PaymentListItem.vue";
export default {
    components: {
        PaymentListItem,
        Message,
        Agree,
    },
    props: {
        name: {
            type: String
        },
        uri: {
            type: String
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
            infiniteId: 1
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
                        console.log({ length: res.data.data.length })
                        this.page += 1;
                        this.payments.push(...res.data.data);
                        $state.loaded()
                    } else {
                        console.log('entra aki tambien?')
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
                if (!this.$refs.infiniteLoading.status) {
                    this.$refs.infiniteLoading.stateChanger.reset();
                }
            });
        },
    },

};
</script>
