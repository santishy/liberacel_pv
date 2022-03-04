<template>
    <div
        v-if="user_id"
        class="
            flex flex-col
            justify-center
            bg-white
            shadow-sm
            w-full
            rounded-sm
            max-w-full
            sm:overflow-x-hidden
            overflow-x-auto
        "
    >
        <div
            v-if="commissions.length"
            class="
                my-2
                mx-2
                rounded-sm
                bg-orange-100
                shadow-inner
                p-2
                flex flex-wrap
                justify-between
                items-center
            "
        >
            <h3 class="text-blue-800 font-mono font-extralight">
                Usuario: {{ username }}
            </h3>
            <span
                class="
                    text-green-800
                    rounded
                    bg-indigo-100
                    p-2
                    font-mono font-semibold
                    text-xl
                "
                >Total: {{ totalWithFormat }}</span
            >
        </div>
        <table
            class="
                min-w-full
                border-collapse
                block
                md:table
                shadow-sm
                text-center
                rounded-lg
            "
        >
            <thead class="block md:table-header-group">
                <tr
                    class="
                        border-b border-gray-500
                        rounded-t-sm
                        md:border-none
                        block
                        md:table-row
                        absolute
                        -top-full
                        md:top-auto
                        -left-full
                        md:left-auto md:relative
                    "
                >
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Nota
                    </th>
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Fecha
                    </th>
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Producto/s
                    </th>
                    <th
                        class="
                            bg-blue-700
                            p-2
                            text-white
                            font-semibold
                            md:border md:border-grey-500
                            text-left
                            block
                            md:table-cell
                        "
                    >
                        Monto
                    </th>
                </tr>
            </thead>
            <tbody class="block md:table-row-group alternate-table-row">
                <commission-list-item
                    v-for="commission in commissions"
                    :key="commission.id"
                    :commission="commission"
                >
                </commission-list-item>
            </tbody>
        </table>
        <infinite-loading
            @infinite="getCommissions"
            :identifier="infiniteId"
            ref="infiniteLoading"
        ></infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
import CommissionListItem from "./CommissionListItem.vue";

export default {
    components: { CommissionListItem, InfiniteLoading},
    data() {
        return {
            commissions: [],
            user_id: null,
            infiniteId: 1,
            page: 1,
            total: 0,
            totalWithFormat: "",
            username: null,
            range: {},
            statusFilter: {
                "filter[completedStatus]": "completed",
            },
        };
    },
    created() {
        EventBus.$on("get-user-commissions", (userData) => {
            const { user, ...filter } = userData;
            this.username = user.username;
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
                        ...this.statusFilter,
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
