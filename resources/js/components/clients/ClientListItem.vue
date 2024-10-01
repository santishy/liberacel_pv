<template>
    <tr>
        <td class="py-2 px-1">{{ client.name }}</td>
        <td class="py-2 px-1">{{ client.address }}</td>
        <td class="py-2 px-1">{{ client.phone_number }}</td>
        <td class="py-2 px-1">{{ client.email }}</td>
        <td class="py-2 px-1">{{ client.company }}</td>
        <td class="py-2 px-1 flex items-center justify-start gap-2">
            <a :href="` clients/${client.phone_number}/edit`" v-can="'edit client'"
                class="bg-sky-500 inline-block cursor-pointer hover:bg-sky-700 text-white font-bold p-1 focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 rounded">
                <edit-icon></edit-icon>
            </a>
            <button @click="deleteClient" v-can="'delete client'"
                class="bg-red-500 hover:bg-red-700 text-white font-bold p-1  hover:border-red-500 rounded focus:ring-2 focus:ring-slate-300 focus:ring-offset-2">
                <trash-icon></trash-icon>
            </button>
        </td>
    </tr>
</template>
<script>
import TrashIcon from "../icons/TrashIcon.vue";
import EditIcon from "../icons/EditIcon.vue";
export default {
    components: { TrashIcon, EditIcon },
    props: {
        client: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    },
    methods: {
        deleteClient() {
            axios
                .delete(`/clients/${this.client.phone_number}`)
                .then(res => {
                    if (res.data) {
                        EventBus.$emit("client-removed", this.index);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
