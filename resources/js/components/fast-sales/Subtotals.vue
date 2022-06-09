<template>
    <div
        v-if="currentFastSale"
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
        <div class="flex flex-wrap justify-between">
            <div class="flex flex-wrap">

                <span class="rounded-sm px-2 bg-green-700 text-white font-semibold">
                    Pts: {{ currentFastSale.customer_bonus.accumulated_points }}
                </span>
    
                <div class="text-sm px-2 ml-2">
                    Dinero electroinco:
                    <span class="text-base font-semibold text-blue-700">
                        {{ currentFastSale.electronicMoney }}
                    </span>
                </div>

            </div>
            <div>
                Total con descuento {{  }}
            </div>
        </div>
        <pre>
            {{ currentFastSale }}
        </pre>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    methods: {},
    computed: {
        ...mapState(["currentFastSale"]),
    },
};
</script>
