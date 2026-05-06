<template>
    <div class=" table-container-responsive ">
        <information-component id="edit-raffle-number">
            <template #title>
                Boleto número: {{ raffleNumber?.code ?? '' }}
            </template>
            <raffle-number-customer-phone-form @raffle-number-customer-phone-updated="raffleNumberCustomerPhoneUpdated"
                :raffle-number="raffleNumber" />
        </information-component>
        <div class="flex justify-between px-4 py-2">
            <raffle-number-status-filter @filter-changed="handleSearch" />
            <search-input classes="w-96" placeholder="Buscar número de rifa" v-model="searchQuery"
                @search="handleSearch"></search-input>
        </div>
        <table class="report-table">
            <thead class=" report-table-thead">
                <tr>
                    <th class="px-2 py-2">Número</th>
                    <th class="px-2 py-2">Status</th>
                    <th class="px-2 py-2">Fecha</th>
                    <th class="px-2 py-2">Nom. Tel.</th>
                    <th class="px-2 py-2">Tipo de venta</th>
                    <th class="px-2 py-2">Nota</th>
                    <th class="px-2 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <raffle-number-list-item v-for="(number, index) in numbers" :key="number.id" :raffle-number="number"
                    @raffle-number-selected="openPhoneEditModal" :index="index">
                </raffle-number-list-item>
            </tbody>
        </table>
        <infinite-loading ref="infiniteLoading" @infinite="fetchRaffleNumbers"></infinite-loading>

    </div>
</template>

<script>
import { mapActions } from 'vuex';
import RaffleNumberListItem from './RaffleNumberListItem.vue';
import SearchInput from '../ui/SearchInput.vue';
import RaffleNumberStatusFilter from './RaffleNumberStatusFilter.vue';
import InformationComponent from '../modals/InformationComponent.vue';
import RaffleNumberCustomerPhoneForm from './RaffleNumberCustomerPhoneForm.vue';
export default {

    components: {
        RaffleNumberListItem,
        SearchInput,
        RaffleNumberStatusFilter,
        InformationComponent,
        RaffleNumberCustomerPhoneForm
    },
    created() {
        EventBus.$on('delete-raffle', (index) => {
            if (this.numbers[index])
                this.numbers[index].status = 'finished'
        })
    },
    mounted() {
        EventBus.$on('raffle-number-available', (index) => {
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
            searchQuery: '',
            status: null,
            statusOptions: [
                'available',
                'assigned',
                null
            ],
            raffleNumber: null,
            raffleNumberIndex: null,
        }
    },
    methods: {
        ...mapActions('raffles', ['getRaffleNumbers']),
        raffleNumberCustomerPhoneUpdated(customer_phone) {
            if (this.raffleNumberIndex !== null && this.numbers[this.raffleNumberIndex]) {
                this.numbers[this.raffleNumberIndex].customer_phone = customer_phone;
            }
            EventBus.$emit('open-modal', false);
        },
        async fetchRaffleNumbers($state) {
            try {
                const res = await this.getRaffleNumbers({ page: this.page, filter: { search: this.searchQuery, byStatus: this.status } });
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
        },
        openPhoneEditModal(raffleNumber, index) {
            this.raffleNumber = raffleNumber;
            this.raffleNumberIndex = index;
            EventBus.$emit('open-modal-edit-raffle-number', true);
        },
        handleSearch(status) {
            this.status = null;
            if (typeof status === 'string' && this.statusOptions.includes(status)) {
                this.status = status;
            }
            this.page = 1;
            this.numbers = [];
            this.fetchRaffleNumbers({
                loaded: () => { },
                complete: () => { }
            });
        }
    }
}
</script>
