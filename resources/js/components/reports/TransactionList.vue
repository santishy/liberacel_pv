<template>
    <div class="container mx-auto mt-4 flex justify-center">
        <information-component>
            <template slot="title">
                Reportes
            </template>

            <message
                :title="modalDataConfirm.title"
                :message="modalDataConfirm.message"
            ></message>

            <agree
                slot="button"
                :method="modalDataConfirm.action"
                @cancelTransaction="cancelTransaction"
            ></agree>
        </information-component>

        <table v-if="params" class="table-auto bg-white text-center">
            <thead>
                <tr class="bg-purple-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Usuario</th>
                    <th v-if="areTheySales">Cliente</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Ver</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>

            <transition-group name="bounce" tag="tbody" @after-leave="afterLeave">
                <transaction-list-item
                    v-for="(transaction, index) in transactions"
                    :transaction="transaction"
                    :index="index"
                    :transaction-type="transaction.transactionType"
                    :key="transaction.id"
                    :uri="uri"
                    :are-they-sales="areTheySales"
                >
                </transaction-list-item>
            </transition-group>

            <infinite-loading
                @infinite="infiniteHandler"
                :identifier="infiniteId"
                ref="infiniteLoading"
            ></infinite-loading>
        </table>
    </div>
</template>
<script>
import { mapMutations, mapState } from "vuex";
import InfiniteLoading from "vue-infinite-loading";

import Message from "../alerts/Message.vue";
import Agree from "../alerts/Agree.vue";
import InformationComponent from "../modals/InformationComponent.vue";
import TransactionListItem from "./TransactionListItem.vue";
export default {
    components: {
        TransactionListItem,
        Message,
        Agree,
        InfiniteLoading,
        InformationComponent
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
            transactions: [],
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
            axios
                .get(this.uri, {
                    params: {
                        page: this.page,
                        ..._.merge(this.params, this.getRelathionships),
                        ...this.searchTheWarehouses
                    }
                })
                .then(res => {
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.data.length) {
                        this.page += 1;
                        this.transactions.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.transactions = [];
            this.infiniteId += 1;
        },
        async cancelTransaction() {
            await axios
                .delete(this.uri + "/" + this.modalDataConfirm.transaction.id, {
                    params: {
                        factor: this.getFactor(),
                        inventory_id: this.modalDataConfirm.transaction
                            .inventory_id
                    }
                })
                .then(res => {
                    if (res.data.status == "cancelled") {
                        this.transactions.splice(
                            this.modalDataConfirm.index,
                            1
                        );
                    }
                })
                .catch(err => {
                    EventBus.$emit("errors-found", err);
                });
            this.setModalDataConfirm({});
            EventBus.$emit("open-modal", false);
        },
        ...mapMutations(["setModalDataConfirm"]),
        getFactor() {
            if (this.modalDataConfirm.transaction.transactionType == "purchase")
                return -1;
            if (this.modalDataConfirm.transaction.transactionType == "sale")
                return 1;
        },
        afterLeave() {
            this.$nextTick(() => {
                if (!this.$refs.infiniteLoading.status) {
                    this.$refs.infiniteLoading.stateChanger.reset();
                }
            });
        },
    },
    computed: {
        ...mapState(["modalDataConfirm"]),
        getRelathionships() {
            if (this.name.toUpperCase() == "VENTAS") {
                return { include: "user,client" };
            } else if (this.name.toUpperCase() == "COMPRAS") {
                return { include: "user" };
            }
        },
        areTheySales() {
            return this.name.toUpperCase() == "VENTAS";
        },
    }
};
</script>
