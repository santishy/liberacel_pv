<template>
    <form class="bg-white rounded shadow px-4 py-6 grid grid-cols-2  gap-4 w-full" @submit.prevent="submit">
        <h3 class="font-mono col-span-2 text-2xl w-full">Crear rifa</h3>
        <div class="col-span-2 sm:col-span-1">
            <label class="form-label">Inventarios</label>
            <search-select :value="raffle?.inventory_id" class="w-full" :collection="inventories"
                input-class="form-text-input w-full"></search-select>
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="form-label">Nombre</label>
            <input name="name" ref="description" v-model="form.name" class="form-text-input w-full"
                placeholder="Nombre de la rifa." autocomplete="off" />
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="form-label">Descripción</label>
            <input name="name" ref="description" v-model="form.description" class="form-text-input w-full "
                placeholder="Nombre de la rifa." autocomplete="off" />
        </div>
        <div>
            <label class="form-label"">Total importe</label>
            <input type=" number" name="min_sale_total" v-model="form.min_sale_total" class="form-text-input w-full"
                placeholder="Ejemplo: 5" autocomplete="off" />
        </div>
        <div>
            <label class="form-label"">Número total de boletos</label>
            <input :disabled="isEdit" type=" number" name="total_numbers" v-model="form.total_numbers"
                class="form-text-input w-full disabled:cursor-not-allowed disabled:bg-gray-200"
                placeholder="Ingresa el número total de boletos" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Fecha de inicio</label>
            <input type="date" ref="start_date" name="start_date" v-model="form.start_date"
                class="form-text-input w-full" placeholder="Fecha de inicio" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Fecha de fin</label>
            <input type="date" ref="end_date" name="end_date" v-model="form.end_date" class="form-text-input w-full"
                placeholder="Fecha de fin" autocomplete="off" />
        </div>

        <div class="col-span-2">
            <errors-component />
        </div>
        <div class="grid-span-2 flex items-center justify-end col-span-2">
            <button
                class="btn w-full bg-sky-500 hover:bg-sky-700 text-white font-bold rounded shadow hover:shadow-none px-2 py-1">Guardar</button>
        </div>
    </form>
</template>
<script>
import InputText from '../partials/InputText.vue';
import SearchSelect from '../partials/SearchSelect.vue';
import { mapGetters } from 'vuex';
export default {
    name: "RaffleForm",
    components: { InputText, SearchSelect },
    inject: ['raffleCtx'],
    data() {
        return { form: {} }
    },
    props: {
        method: {
            type: String,
            default: 'post'
        }
    },
    mounted() {
        // if (this.currentSelectedRaffle) {
        //     this.fillOutForm(this.currentSelectedRaffle)
        // }
        EventBus.$on('selected-item', item => {
            if (!item) {
                return;
            }
            this.form.inventory_id = item.id;
        });
    },
    watch: {
        raffle: {
            immediate: true,
            handler(val) {
                this.fillForm(val);
            }
        }
    },
    methods: {
        async submit() {
            const url = this.isEdit ? `/raffles/${this.raffle.id}` : '/raffles'
            try {
                const response = await axios[this.method](url, this.form);
                let payload;
                if (response.status === 201) {
                    payload = {
                        type: 'primary',
                        title: 'Rifa creada',
                        text: 'La rifa ha sido creada exitosamente.'
                    }
                }
                if (response.status === 200) {
                    payload = {
                        type: 'success',
                        title: 'Rifa actualizada',
                        text: 'La rifa ha sido actualizada exitosamente.'
                    }
                }
                this.notify(payload);

            } catch (error) {

                EventBus.$emit('an-error-ocurred', error);

            }
        },

        fillForm(raffle) {
            if (!!raffle) {
                this.form.name = raffle.name;
                this.form.total_numbers = raffle.total_numbers;
                this.form.inventory_id = raffle.inventory_id;
                this.form.description = raffle.description;
                this.form.start_date = (raffle.start_date ?? '').toString().slice(0, 10);
                this.form.end_date = (raffle.end_date ?? '').toString().slice(0, 10);
                this.form.min_sale_total = raffle.min_sale_total;
            }
        }

    },
    computed: {
        raffle() {
            return this.raffleCtx?.raffle;
        },
        isEdit() {
            return !!this.raffleCtx.raffle?.id
        },
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-serif font-semibold mr-2 rounded-sm py-3 px-6";
        },
        inputStyle() {
            return " placeholder:italic font-font-light placeholder-gray-500 placeholder-shown:border-gray-500 appearance-none bg-gray-300  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
        ...mapGetters('inventories', ['inventories']),
        ...mapGetters('raffles', ['getSelectedRaffle']),
        raffle() {
            return this.raffleCtx?.raffle;
        }
    }
}
</script>
