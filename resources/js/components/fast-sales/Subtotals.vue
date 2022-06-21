<template>
    <div
        v-if="currentFastSaleNotEmpty"
        class="
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
        "
    >
        <div class="flex flex-wrap justify-between w-full">
            <div class="flex flex-wrap">
                <span
                    class="
                        rounded-sm
                        px-2
                        bg-green-700
                        text-white
                        font-semibold
                    "
                >
                    Pts: {{ currentFastSale.customer_bonus.accumulated_points }}
                </span>

                <div class="text-sm px-2 ml-2">
                    Dinero electronico:
                    <span class="text-base font-semibold text-blue-700">
                        {{ currentFastSale.electronicMoney }}
                    </span>
                </div>
            </div>
            <div class="font-black">
                Total con descuento
                {{ totalLessDiscount }}
            </div>
        </div>
    
    </div>
</template>

<script>
import { mapState } from "vuex";
import ApplyElectronicMoneyDiscount from "./ApplyElectronicMoneyDiscount.vue";
export default {
    components:{
        ApplyElectronicMoneyDiscount
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
            let electronicMoney = this.currentFastSale.electronicMoney.replace(
                "$",
                ""
            );
            electronicMoney = parseFloat(electronicMoney);
            var formatter = new Intl.NumberFormat("mx-MX", {
                style: "currency",
                currency: "MXN",
            });
            return formatter.format(
                this.currentFastSale.total_unformatted - electronicMoney
            );
        },
    },
};
</script>
