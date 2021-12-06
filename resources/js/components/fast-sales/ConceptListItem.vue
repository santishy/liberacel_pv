<template>
    <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
        <form>
        <td class="border-grey-light border hover:bg-gray-100 p-3">
            <span>{{ product.description }}</span>
            <input type="text" v-model="form.description" class="">
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-3">
            <span>{{ product.price }}</span>
             <input type="text" v-model="form.description" class="">
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-3">
            <span>{{ product.qty }}</span>
             <input type="text" v-model="form.description" class="">
        </td>
        <td
            class="
                border-grey-light border
                hover:bg-gray-100
                p-3
                text-red-400
                hover:text-red-600 hover:font-medium
                cursor-pointer
            "
        ></td>
        </form>
    </tr>
</template>

<script>
export default {
    props: {
        product: {
            required: true,
            type: Object,
        },
    },
    data(){
        return{
            show: false,
            form:{}
        }
    }
};
</script>
