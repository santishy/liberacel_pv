<template>
    <div class="table-container-responsive">
        <table v-if="params" class="report-table">
            <thead class="report-table-thead">
                <tr class="bg-green-200">
                    <th class="py-2 px-2">FECHA</th>
                    <th class="py-2 px-2">CONCEPTO</th>
                    <th class="py-2 px-2">IMPORTE</th>
                    <th class="py-2 px-2">ACCIONES</th>
                </tr>
            </thead>

            <transition-group name="bounce" tag="tbody" @after-leave="afterLeave">
                <expense-list-item v-for="(expense, index) in expenses" :key="expense.id" :expense="expense" :index="index">
                </expense-list-item>
            </transition-group>

            <infinite-loading @infinite="infiniteHandler" :identifier="infiniteId" ref="infiniteLoading"></infinite-loading>
        </table>
    </div>
</template>

<script>

// import Message from "../../alerts/Message.vue";
// import Agree from "../../alerts/Agree.vue";
import ExpenseListItem from "./ExpenseListItem.vue";
export default {
    components: {
        ExpenseListItem,
        // Message,
        // Agree,
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
            expenses: [],
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
            if (this.params["filter[status]"]) {
                delete this.params["filter[status]"];
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
                    console.log({ res })
                    if (this.page == 1)
                        EventBus.$emit("calculated-total", res.data.total);
                    if (res.data.data.length) {
                        this.page += 1;
                        this.expenses.push(...res.data.data);
                        $state.loaded()
                    } else {
                        $state.complete();
                    }
                });
        },
        changeParams(value) {
            this.params = value;
            this.page = 1;
            this.expenses = [];
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
