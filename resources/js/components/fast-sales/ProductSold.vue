<template>
    <tr>
        <td class="border px-4 py-2">{{ transaction.id }}</td>
        <td class="border px-4 py-2 text-sm">{{ transaction.user_name }}</td>
        <td class="border px-4 py-2 text-xs">{{ transaction.created_at }}</td>
        <td class="border px-4 py-2">{{ transaction.description }}</td>
        
        <td class="border px-4 py-2">{{ transaction.price }}</td>
        <td class="border px-4 py-2">{{ transaction.qty }}</td>
        <td class="border px-4 py-2">
            ${{ transaction.qty * transaction.price }}
        </td>
        <td class="border px-4 py-2 text-green-800 font-semibold">${{ transaction.total }}</td>
        <td class="border px-4 py-2 flex flex-wrap">
            <a
                :href="`/fast-sale-tickets/${transaction.id}`"
                class="cursor-pointer block p-2 text-blue-600 "
                target="_blank"
            >
                <printer-icon></printer-icon>
            </a>
            <a
                href="#"
                @click.prevent="openModal"
                class="cursor-pointer block p-2 text-red-600 "
                
            >
                <trash-icon></trash-icon>
            </a>
        </td>
    </tr>
</template>
<script>
import PrinterIcon from "../icons/PrinterIcon.vue";
import TrashIcon from "../icons/TrashIcon.vue";
export default {
    components:{ PrinterIcon,TrashIcon},
    props: {
        transaction: {
            type: Object,
        },
    },
    methods:{
        openModal(){
            
            EventBus.$emit("open-modal",true);
            EventBus.$emit("id-for-authenticacion-form",this.transaction.id);
        }
    }
};
</script>
