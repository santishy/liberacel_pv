<template>
    <tr class="py-2 px-1 text-base">
        <td class="py-1 px-2 
        text-xs">
            {{ raffleNumber.code }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffleNumber.status }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffleNumber.assigned_at ?? '-' }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffleNumber.customer_phone ?? '-' }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffleNumber.saleable_type ?? '-' }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffleNumber.ticket_number ?? '-' }}
        </td>
        <td class="py-1 px-2 text-xs flex items-center justify-center space-x-2 text-white">

            <button @click.prevent="deactivate(raffleNumber.id)" v-can="'delete raffleNumber'"
                :disabled="raffleNumber.status === 'DISPONIBLE'"
                class="bg-gray-500 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:bg-gray-500 hover:bg-gray-700 font-bold hover:shadow-none transition-all shadow-xs  font-bold p-1  rounded">
                <minus></minus>
            </button>
        </td>
    </tr>
</template>
<script>
import EditIcon from '../icons/EditIcon.vue';
import Minus from '../icons/Minus.vue';
export default {
    components: { EditIcon, Minus },
    props: {
        raffleNumber: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    },
    methods: {
        async deactivate(id) {
            try {
                const resp = await axios.put('/raffle-numbers/' + id, {
                    status: 'available'
                });
                if (resp.data.data.status === 'DISPONIBLE') {
                    EventBus.$emit('raffle-number-available', this.index);
                }
            } catch (error) {
                console.log(error)
            }

        }
    }
}
</script>