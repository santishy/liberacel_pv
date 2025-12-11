<template>
    <form class="bg-white rounded shadow px-4 py-6 grid grid-cols-2  gap-4 w-full" @submit.prevent="submit">
        <h3 class="font-mono col-span-2 text-2xl w-full">Crear rifa</h3>
         <div class="col-span-2 sm:col-span-1">
             <label class="form-label">Inventarios</label>
                 <search-select v-model="form.inventory_id" class="w-full" :collection="inventories"
                     input-class="form-text-input w-full"></search-select>
         </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="form-label">Nombre</label>
            <input name="name" ref="description" v-model="form.name"
                class="form-text-input w-full"
                placeholder="Nombre de la rifa." autocomplete="off" />
        </div>
         <div class="col-span-2 sm:col-span-1">
            <label class="form-label">Descripción</label>
            <input name="name" ref="description" v-model="form.description"
                class="form-text-input w-full "
                placeholder="Nombre de la rifa." autocomplete="off" />
        </div>
        <div>
            <label class="form-label"">Total de venta mínima</label>
            <input type="number"  name="min_sale_total" v-model="form.min_sale_total" class="form-text-input w-full"
                placeholder="Ejemplo: 5" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Fecha de inicio</label>
            <input type="date" ref="start_date" name="start_date" v-model="form.start_date" class="form-text-input w-full"
                placeholder="Fecha de inicio" autocomplete="off" />
        </div>
        <div>
            <label class="form-label">Fecha de fin</label>
            <input type="date" ref="end_date" name="end_date" v-model="form.end_date" class="form-text-input w-full"
                placeholder="Fecha de fin" autocomplete="off" />
        </div>

        <div class="col-span-2">
            <errors-component/>
        </div>
        <div class="grid-span-2 flex items-center justify-end col-span-2">
            <button class="btn w-full bg-sky-500 hover:bg-sky-700 text-white font-bold rounded shadow hover:shadow-none px-2 py-1">Guardar</button>
        </div>
    </form>
</template>
<script>
import InputText from '../partials/InputText.vue';
import SearchSelect from '../partials/SearchSelect.vue';
import { mapGetters } from 'vuex';
export default {
    name: "RaffleForm",

    components: { InputText,SearchSelect },
    data() {
        return { form:{}}
    },
    mounted(){
        EventBus.$on('selected-item', item => {
            if (!item) {
                return;
            }
            this.form.inventory_id = item.id;
        });
    },
    methods: {
        async submit(){
            try{
               const response = await axios.post('/raffles', this.form);
                if(response.status === 201){
                    this.notify({
                        type: 'primary',
                        title: 'Rifa creada',
                        text: 'La rifa ha sido creada exitosamente.'
                    });
                }
            }catch(error){
               EventBus.$emit('an-error-ocurred', error);
                console.error(error);
            }
        }
    },
    computed:{
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-serif font-semibold mr-2 rounded-sm py-3 px-6";
        },
        inputStyle() {
            return " placeholder:italic font-font-light placeholder-gray-500 placeholder-shown:border-gray-500 appearance-none bg-gray-300  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
        ...mapGetters('inventories',['inventories'])
    }
}
</script>
