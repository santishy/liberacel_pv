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
                href="#"
                class="w-full h-full pointer text-blue-400"
                v-if="show"
                @click.prevent="show = false"
                >{{ commission.amount }}</a
            >
            <input v-else type="text" class="rounded-sm border border-gray-400 bg-gray-200" v-model="amount" />
        </td>
    </tr>
</template>
<script>
export default {
    props: {
        commission: {
            type: Object,
        },
    },
    data() {
        return {
            show: true,
            amount: commission.amount,
        };
    },
    computed: {
        changeProductFormat() {
            return this.commission.products.map((product) => {
                return `Descripción: ${product.description} Cantidad: ${product.qty} Precio: ${product.price}`;
            });
        },
    },
};
</script>
