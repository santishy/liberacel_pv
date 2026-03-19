<template>
    <tr class="py-2 px-1 text-base">
        <td class="py-1 px-2 text-xs">
            {{ raffle.name }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffle.description }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffle.formatted_start_date }}
        </td>
        <td class="`py-1 px-2 text-xs`">
            {{ raffle.formatted_end_date }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffle.total_numbers }}
        </td>
        <td class="py-1 px-2 text-xs">
            {{ raffle.status }}
        </td>
        <td class="py-1 px-2 text-xs flex items-center justify-around text-white">
            <a class="p-1 transiton-all rounded bg-sky-500 hover:bg-sky-700 shadow hover:shadow-none"
                :href="`/raffles/${raffle.id}/edit`">
                <edit-icon />
            </a>
            <button @click.prevent="deactivate(raffle.id)" v-can="'delete raffle'"
                class="bg-red-500 hover:bg-red-700 hover:shadow-none transition-all shadow-xs  font-bold p-1  rounded">
                <trash-icon></trash-icon>
            </button>
        </td>
    </tr>
</template>
<script>
import EditIcon from '../icons/EditIcon.vue';
import TrashIcon from '../icons/TrashIcon.vue';
export default {
    components: { EditIcon, TrashIcon },
    props: {
        raffle: {
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
                const resp = await axios.delete('/raffles/' + id);
                if (resp?.status === 204) {
                    EventBus.$emit('delete-raffle', this.index);
                }
            } catch (error) {
                console.log(error)
            }

        }
    }
}
</script>