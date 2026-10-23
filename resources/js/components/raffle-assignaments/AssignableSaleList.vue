<template>
    <div class="table-container-responsive">
        <h2 class="block w-full text-center text-2xl pt-2 text-gray-700 font-semibold mb-2">Agregar o corregir teléfono
            de rifa en las notas de hoy</h2>
        <div class="flex justify-between px-4 py-2">
            <!-- FILTROS -->
            <select v-model="type" @change="selectedType"
                class="appearance-none border-sky-500 rounded w-full text-gray-700 mr-3 py-1 text-center leading-tight focus:outline-none">
                <option value="" disabled>Elige un tipo de venta</option>
                <option value="FastSale">Expres</option>
                <option value="Sale">Stock</option>
            </select>
        </div>
        <table v-if="type !== ''" class="report-table">
            <thead class="report-table-thead">
                <tr>
                    <th class="px-2 py-2">Nota</th>
                    <th class="px-2 py-2">Status</th>
                    <th class="px-2 py-2">Usuario</th>
                    <th class="px-2 py-2">Nom. Tel.</th>
                    <th class="px-2 py-2">total</th>
                    <th class="px-2 py-2">
                        Fecha
                    </th>
                    <th class="px-2 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="sale in assignableSales">
                    <td>{{ sale.id }}</td>
                    <td>{{ sale.status }}</td>
                    <td>{{ sale.name }}</td>
                    <td>{{ sale.customer_phone }}</td>
                    <td>{{ sale.total }}</td>
                    <td>{{ sale.created_at }}</td>
                    <td>
                        <button
                            class="bg-sky-400 flex items-center gap-1 mx-auto text-white font-medium hover:bg-sky-700 hover:text-slate-100 rounded px-2 py-1 text-xs"
                            @click.prevent="onSelectedAssignableSale(sale)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 3.75 18 6m0 0 2.25 2.25M18 6l2.25-2.25M18 6l-2.25 2.25m1.5 13.5c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                            </svg>
                            {{ sale.customer_phone ? 'Corregir teléfono' : 'Agregar teléfono' }}
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <infinite-loading v-if="type !== ''" ref="infiniteLoading" :identifier="infiniteId"
            @infinite="fetchAssignableSales"></infinite-loading>
        <information-component id="edit-raffle-number">
            <template #title> Agregar teléfono </template>
            <add-raffle-phone-form :uri="getUri" :key="rafflePhoneFormKey"
                :customer-phone="selectedAssignableSale?.customer_phone"
                @raffle-phone-number-saved="updateProductList" />
        </information-component>
    </div>
</template>

<script>
import InformationComponent from '../modals/InformationComponent.vue';
import AddRafflePhoneForm from '../raffle-numbers/AddRafflePhoneForm.vue';
export default {
    components: { InformationComponent, AddRafflePhoneForm },
    data() {
        return {
            assignableSales: [],
            params: {},
            page: 1,
            selectedAssignableSale: null,
            type: '',
            rafflePhoneFormKey: 1,
            infiniteId: 1
        }
    },
    methods: {
        selectedType() {
            this.changeParams();
            this.params['type'] = this.type;
        },
        changeParams() {
            this.params = {};
            this.page = 1;
            this.assignableSales = [];
            this.infiniteId += 1;
        },
        onSelectedAssignableSale(sale) {

            this.rafflePhoneFormKey++;
            this.selectedAssignableSale = sale;
            EventBus.$emit("open-modal-edit-raffle-number", true)
        },
        updateProductList({ raffle_number, customer_phone }) {
            const assignableSale = this.assignableSales.find(
                (sale) =>
                    sale.id === this.selectedAssignableSale.id
            )
            if (assignableSale)
                assignableSale["customer_phone"] = customer_phone;
        },
        async fetchAssignableSales($state) {
            try {
                const { data } = await axios.get(`/raffle-assignments/assignables`,
                    { params: { ...this.params, page: this.page } }
                )
                const rows = data?.data || [];
                this.assignableSales.push(...rows);
                if (data.data.length) {
                    this.page += 1;
                    $state.loaded();
                } else {
                    $state.complete();
                }
            } catch (err) {
                console.log(err)
            }
        }
    },
    computed: {
        getUri() {
            const uri = {
                FastSale: `/fast-sales/${this.selectedAssignableSale?.id}/customer-phone`,
                Sale: `/sales/${this.selectedAssignableSale?.id}/customer-phone`
            }
            return uri[this.type] ?? '';
        }
    }
}
</script>
