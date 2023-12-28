<template>
    <div v-if="user_id" class="
            flex flex-col
            justify-center
            bg-white
            shadow-sm
            w-full
            rounded-sm
            max-w-full
            sm:overflow-x-hidden
            overflow-x-auto
        ">
        <div v-if="commissions.length" class="
                my-2
                mx-2
                rounded-sm
                bg-yellow-300
                p-2
                flex flex-wrap
                justify-between
                items-center
            ">
            <h3 class="text-slate-600 font-mono font-extralight">
                Usuario: {{ name }}
            </h3>
            <span class="
                    text-green-800
                    rounded
                    p-2
                    font-mono font-semibold
                    text-xl
                ">Total: {{ totalWithFormat }}</span>
        </div>
        <div class="table-container-responsive">

            <table class="report-table">
                <thead class="report-table-thead">
                    <tr class="bg-emerald-200">
                        <th class="px-2 py-2">
                            Tipo de venta
                        </th>
                        <th class="px-2 py-2">
                            Nota
                        </th>
                        <th class="px-2 py-2">
                            Fecha
                        </th>
                        <th class="px-2 py-2">
                            Producto/s
                        </th>
                        <th class="px-2 py-2">
                            Monto
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <commission-list-item v-for="commission in commissions" :key="commission.id" :commission="commission">
                    </commission-list-item>
                </tbody>
            </table>
            <infinite-loading @infinite="getCommissions" :identifier="infiniteId" ref="infiniteLoading"></infinite-loading>
        </div>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import CommissionListItem from "./CommissionListItem.vue";

export default {
    components: { CommissionListItem, InfiniteLoading },
    data() {
        return {
            commissions: [],
            user_id: null,
            infiniteId: 1,
            page: 1,
            total: 0,
            totalWithFormat: "",
            name: null,
            range: {},
            statusFilter: {
                "filter[completedStatus]": "completed",
            },
        };
    },
    created() {
        EventBus.$on("get-user-commissions", (userData) => {
            const { user, ...filter } = userData;
            this.name = user.name;

            this.commissions = [];
            this.range = filter;
            this.user_id = user.id;
            this.page = 1;
            this.infiniteId += 1;
        });
        EventBus.$on("updated-commission", (data) => {
            this.total =
                this.total - data.oldCommission + data.updatedCommission;
            this.totalWithFormat =
                "$" + new Intl.NumberFormat("es-MX").format(this.total);
        });
    },
    methods: {
        getCommissions($state) {
            axios
                .get("/user-commissions/", {
                    params: {
                        page: this.page,
                        user_id: this.user_id,
                        ...this.range,
                        //...this.statusFilter,
                    },
                })
                .then((res) => {
                    if (this.page == 1) {
                        this.totalWithFormat = res.data.totalWithFormat;
                        this.total = res.data.total;
                    }
                    if (res.data.commissions.length) {
                        this.page += 1;
                        this.commissions.push(...res.data.commissions);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch((err) => {
                    this.getErrors(err);
                });
            this.dates = null;
        },
    },
};
</script>
