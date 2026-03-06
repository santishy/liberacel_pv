<template>
    <layout-component>
        <div
            class="relative overflow-x-auto bg-white scroll-smooth scrollbar-track-transparent  scrollbar-thumb-sky-700 scrollbar-thin">
            <table class="w-full text-sm text-left text-slate-500 ">
                <thead class=" text-slate-700 uppercase bg-slate-100">
                    <tr>
                        <th class="px-2 py-2">Nombre</th>
                        <th class="px-2 py-2">Dirección</th>
                        <th class="px-2 py-2">Número tel.</th>
                        <!-- <th class="px-2 py-2">Email</th> -->
                        <th class="px-2 py-2">Empresa</th>
                        <th class="px-2 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <client-list-item v-for="(client, index) in clients" :key="client.id" :client="client"
                        :index="index" />
                </tbody>
            </table>
        </div>
        <infinite-loading @infinite="getClients"></infinite-loading>
    </layout-component>
</template>
<script>
//import NavComponent from "../NavComponent.vue";
import ClientListItem from "./ClientListItem.vue";
export default {
    components: { ClientListItem },

    data() {
        return {
            clients: [],
            page: 1,
        };
    },

    mounted() {
        EventBus.$on("client-removed", index => {
            this.clients.splice(index, 1);
        });

    },
    methods: {
        getClients($state) {
            axios
                .get("/clients", {
                    params: {
                        page: this.page,
                    }
                })
                .then(res => {
                    if (res.data.data.length) {
                        this.page += 1;
                        this.clients.push(...res.data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }

                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
