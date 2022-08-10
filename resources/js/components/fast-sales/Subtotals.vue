<template>
    <div v-if="currentFastSaleNotEmpty" class="
            p-2
            border-l-4 border-red-500
            flex flex-wrap
            items-baseline
            md:w-9/12
            mb-4
            mx-auto
            bg-white
            shadow-sm
            rounded
        ">
        <div class="
                flex flex-wrap
                justify-between
                w-full
                items-center
                font-serif
            ">
            <div class="flex flex-wrap items-center">
                <span class="rounded-sm px-2 font-serif font-base">
                    Puntos acumulados:
                    {{ currentFastSale.customer_bonus.accumulated_points }}
                </span>

                <div class="
                        px-2
                        text-base
                        border-l-2 border-r-2 border-gray-600
                        font-serif
                    ">
                    Dinero electronico:
                    <span class="text-base font-semibold text-gray-700">
                        {{ currentFastSale.electronicMoney }}
                    </span>
                </div>
                <div class="text-xl font-serif ml-2">
                    Total con descuento:
                    <span class="text-red-600">

                        {{ totalLessDiscount }}
                    </span>
                </div>
            </div>
            <apply-electronic-money-discount v-if="!currentFastSale.electronicMoneyDiscount">
            </apply-electronic-money-discount>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
import ApplyElectronicMoneyDiscount from "./ApplyElectronicMoneyDiscount.vue";
export default {
    data() {
        return {
            formatter: new Intl.NumberFormat("mx-MX", {
                style: "currency",
                currency: "MXN",
            }),
        };
    },
    components: {
        ApplyElectronicMoneyDiscount,
    },
    computed: {
        ...mapState(["currentFastSale"]),
        currentFastSaleNotEmpty() {
            if (
                this.currentFastSale &&
                this.currentFastSale.customer_bonus instanceof Object
            )
                return true;
            return false;
        },
        totalLessDiscount() {
            let electronicMoney = this.currentFastSale.electronicMoney?.replace(
                "$",
                ""
            );

            electronicMoney = parseFloat(electronicMoney);
            let total =
                this.currentFastSale.total_unformatted - electronicMoney;
            if (total > 0) return this.formatter.format(total);
            else return "$0.00";
        },
    },
};
</script>
