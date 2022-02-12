<template>
    <div
        class="
            flex
            justify-center
            bg-white
            shadow-sm
            w-full
            rounded
            max-w-full
            sm:overflow-x-hidden
            overflow-x-auto
        "
    >
        <table
            v-if="commissions.length"
            v-can="'view warehouses'"
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
    </div>
</template>

<script>
import CommissionListItem from "./CommissionListItem.vue";
export default {
    components: { CommissionListItem },
    data() {
        return {
            commissions: [],
        };
    },
    created() {
        EventBus.$on("commissions-earned", (commissions) => {
            this.commissions = commissions;
        });
    },
};
</script>
