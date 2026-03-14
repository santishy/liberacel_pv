<template>
    <div class="relative overflow-x-auto bg-white w-full">
        <table class="w-full text-left text-slate-500 ">
            <thead class=" text-slate-700 uppercase bg-slate-100">
                <tr>
                    <th class="px-2 py-2">Nombre</th>
                    <th class="px-2 py-2">Descripcion</th>
                    <th class="px-2 py-2">Fecha Inicio</th>
                    <th class="px-2 py-2">Fecha Fin</th>
                    <th class="px-2 py-2">Status</th>
                    <th class="px-2 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <raffle-list-item v-for="(raffle, index) in raffles" :key="raffle.id" :raffle="raffle" :index="index">
                </raffle-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="fetchRaffles"></infinite-loading>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import RaffleListItem from './RaffleListItem.vue';
export default {

    components: {
        RaffleListItem
    },
    created() {
        EventBus.$on('delete-raffle', (index) => {
            if (this.raffles[index])
                this.raffles[index].status = 'finished'
        })
    },
    data() {
        return {
            raffles: [],
            page: 1,
        }
    },
    methods: {
        ...mapActions('raffles', ['getRaffles']),
        async fetchRaffles($state) {
            try {
                const res = await this.getRaffles({ page: this.page })
                const rows = res.data || [];
                this.raffles.push(...rows);
                if (res.next_page_url) {
                    this.page += 1;
                    $state.loaded()
                } else {
                    $state.complete()
                }
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>