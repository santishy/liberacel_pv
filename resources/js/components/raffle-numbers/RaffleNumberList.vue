<template>
    <div class=" table-container-responsive ">
        <table class="report-table">
            <thead class=" report-table-thead">
                <tr>
                    <th class="px-2 py-2">Número</th>
                    <th class="px-2 py-2">Status</th>
                    <th class="px-2 py-2">Fecha</th>
                    <th class="px-2 py-2">Nom. Tel.</th>
                    <th class="px-2 py-2">Nota</th>
                    <th class="px-2 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <raffle-number-list-item v-for="(number, index) in numbers" :key="number.id" :raffle-number="number"
                    :index="index">
                </raffle-number-list-item>
            </tbody>
        </table>
        <infinite-loading @infinite="fetchRaffleNumbers"></infinite-loading>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import RaffleNumberListItem from './RaffleNumberListItem.vue';
export default {

    components: {
        RaffleNumberListItem
    },
    created() {
        EventBus.$on('delete-raffle', (index) => {
            if (this.numbers[index])
                this.numbers[index].status = 'finished'
        })
    },
    mounted() {
        EventBus.$on('raffle-number-available', (index) => {
            console.log('raffle-number-available', index)
            if (this.numbers[index]) {
                this.numbers[index].status = 'DISPONIBLE'
                this.numbers[index].assigned_at = ''
                this.numbers[index].customer_phone = '-'
                this.numbers[index].ticket_number = '-'
            }

        });
    },
    data() {
        return {
            numbers: [],
            page: 1,
        }
    },
    methods: {
        ...mapActions('raffles', ['getRaffleNumbers']),
        async fetchRaffleNumbers($state) {
            try {
                const res = await this.getRaffleNumbers({ page: this.page })
                const rows = res.data || [];
                this.numbers.push(...rows);
                if (res.data.length) {
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