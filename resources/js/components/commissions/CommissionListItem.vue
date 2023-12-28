<template>
    <tr class="
            py-2 px-1
        ">
        <td class="py-2 px-1 text-slate-600">
            {{ commission.type_of_sale }}
        </td>
        <td class="py-2 px-1 text-slate-700 font-semibold">
            {{ commission.note }}
        </td>
        <td class="py-2 px-1 text-xs text-slate-600">
            {{ commission.created_at }}
        </td>
        <td class="py-2 px-1 max-w-xs sm:max-w-sm md:max-w-2xl">
            <p class="flex flex-wrap divide-x-2 gap-2  ">
                <span class="text-xs px-2 py-[.15rem] rounded bg-sky-600 font-light text-slate-50"
                    v-for="product in commission.commissionable.products" :key="`${product.id}-${commission.type_of_sale}`">
                    {{ product.description }}
                </span>
            </p>
        </td>
        <td class="py-2 px-1">
            <div class="flex items-center">
                <errors-component :errors-found="errors" />
            </div>
            <a v-if="show" href="#" class="w-full h-full pointer block text-blue-400" @click.prevent="hideItem">{{
                commission.amount }}</a>

            <input v-else :ref="`element-${commission.id}`" @keydown.enter="updateAmount" type="text" class="
                    rounded-sm
                    border
                    w-full
                    shadow-inner
                    focus:outline-none
                    p-2
                    border-gray-400
                    bg-gray-200
                " v-model="amount" />

        </td>
    </tr>
</template>
<script>
export default {
    data() {
        return {
            show: true,
            amount: this.commission.amount,
        };
    },
    props: {
        commission: {
            type: Object,
        },
    },
    computed: {
        changeProductFormat() {
            return this.commission.products.map((product) => {
                return `Descripción: ${product.description} Cantidad: ${product.qty} Precio: ${product.price}`;
            });
        },
    },
    methods: {
        async updateAmount(event) {
            let params = { _method: "put" };
            try {
                const res = await axios.post(
                    `/user-commissions/${this.commission.id}`,
                    {
                        ...params,
                        amount: this.amount,
                    }
                );
                this.show = true;
                this.commission.amount = this.amount;
                this.errors = null;
                EventBus.$emit("updated-commission", res.data);
            } catch (error) {
                this.getErrors(error);
            }
        },
        hideItem(event) {
            this.show = false;
            this.$nextTick(() => {
                this.$refs[`element-${this.commission.id}`].focus();
            });
        },
    },
};
</script>
