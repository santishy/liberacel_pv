<template>
    <nav-component>
        <div class="w-full flex justify-center ">
            <div
                class="bg-white shadow rounded max-w-full sm:overflow-x-hidden overflow-x-auto"
            >
                <table v-if="clients.length" v-can="'view clients'" class="table-auto">
                    <thead>
                        <tr class="bg-danger">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Dirección</th>
                            <th class="px-4 py-2">Número tel.</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Empresa</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <client-list-item
                            v-for="(client, index) in clients"
                            :key="client.id"
                            :client="client"
                            :index="index"
                        />
                    </tbody>
                </table>
            </div>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import ClientListItem from "./ClientListItem.vue";
export default {
    components: { ClientListItem, NavComponent },

    data() {
        return {
            clients: []
        };
    },

    mounted() {
        EventBus.$on("client-removed", index => {
            this.clients.splice(index, 1);
        });
        this.getClients();
    },
    methods: {
        getClients() {
            axios
                .get("/clients")
                .then(res => {
                    this.clients.push(...res.data.data);
                    console.log(res.data.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
