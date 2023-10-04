<template>
    <div class="shadow-sm bg-white">
        <table v-if="params" class="table-auto w-full">
            <thead class="bg-blue-700">
                <tr class="text-white font-extralight">
                    <th class="px-1 py-2">FECHA</th>
                    <th class="px-1 py-2">CONCEPTO</th>
                    <th class="px-1 py-2">IMPORTE</th>
                    <th class="px-1 py-2">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <transition-group name="bounce" tag="tbody" @after-leave="afterLeave">
                    <expense-list-item v-for="(expense, index) in expenses" :key="expense.id" :expense="expense"
                        :index="index">
                    </expense-list-item>
                </transition-group>
            </tbody>
            <infinite-loading @infinite="infiniteHandler"></infinite-loading>
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
