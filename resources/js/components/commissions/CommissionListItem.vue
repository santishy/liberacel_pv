<template>
    <tr
        class="
            bg-white
            border-b border-gray-400
            md:border-none
            block
            md:table-row
        "
    >
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Nota</span
            >{{ commission.note }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span
            >{{ commission.created_at }}
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold"
                >Productos</span
            >
            <p
                v-for="item in changeProductFormat"
                :key="item.product"
                class="text-xs text-gray-800"
            >
                {{ item }}
            </p>
        </td>
        <td
            class="
                p-2
                md:border md:border-grey-500
                text-left
                block
                md:table-cell
            "
        >
            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span
            ><a
                v-if="show"
                href="#"
                class="w-full h-full pointer block text-blue-400"
                @click.prevent="hideItem"
                >{{ commission.amount }}</a
            >
            <input
                v-else
                :ref="`element-${commission.id}`"
                @keydown.enter="updateAmount"
                type="text"
                class="
                    rounded-sm
                    border
                    w-full
                    shadow-inner
                    focus:outline-none
                    p-2
                    border-gray-400
                    bg-gray-200
                "
                v-model="amount"
            />
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
                EventBus.$emit("updated-commission", res.data);
            } catch (error) {
                console.log(error);
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
