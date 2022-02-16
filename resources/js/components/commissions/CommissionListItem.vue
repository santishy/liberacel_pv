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
            <span class="inline-block w-1/3 md:hidden font-bold">Fecha</span
            >{{commission.created_at}}
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
            <span class="inline-block w-1/3 md:hidden font-bold">Productos</span
            >{{ changeProductFormat}}
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
            >{{commission.amount}}
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
    computed:{
        changeProductFormat(){
            let products = this.commission.products.map( product => {
                return {
                    "Descripción" : product.description,
                    "Cantidad" : product.qty,
                    "Precio" : product.price
                }
                    

                
            });
            return ;
        }
    }
};
</script>
