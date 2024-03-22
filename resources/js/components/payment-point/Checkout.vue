<template>
    <nav-component>


        <div class="max-w-4xl m-auto bg-white rounded shadow p-4">
            <h1 class="font-bold text-2xl text-slate-800 p-2 text-center">Caja de cobro</h1>
            <div class="flex px-4 py-3 w-full gap-4 bg-slate-900 mb-4 rounded-sm">
                <div class="flex items-center gap-2 ">
                    <input id="inline-radio" type="radio" value="" name="inline-radio-group"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-radio"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Lector</label>
                </div>
                <div class="flex items-center gap-2">
                    <input id="inline-2-radio" type="radio" value="" name="inline-radio-group"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="inline-2-radio"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Manual</label>
                </div>


            </div>

            <form class="w-full" @submit.prevent="submit">
                <div v-if="show" class="">
                    <input name="checkout" placeholder="Haz click y escanea el codigo de barras" v-model="barcode"
                        class="w-full px-4 py-2 rounded-sm bg-slate-200" />
                </div>
                <div v-else class="flex flex-wrap gap-4">
                    <div>
                        <label class="form-label">Categoría</label>
                        <search-select :collection="options" input-class=" form-text-input w-full" />
                    </div>
                    <div>
                        <label class="form-label">Nota</label>
                        <input type="number" v-model="id" class="form-text-input w-full"
                            placeholder="Escribe el número de nota" @keydown.enter="submit" autocomplete="off" />
                    </div>
                </div>
            </form>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
import SearchSelect from "../partials/SearchSelect.vue";
export default {
    components: {
        NavComponent,
        SearchSelect
    },
    created() {
        EventBus.$on('selected-item', item => {
            if (!item) {
                return;
            }
            this.id = item.value;
        })
    },
    data() {
        return {
            barcode: '',
            model: null,
            id: null,
            show: true,
            options: [
                { name: 'Express', value: 'FastSale' },
                { name: 'Stock', value: 'Sale' }
            ]
        }
    },
    methods: {
        async submit() {
            this.parseBarcodeData()
            try {
                if (!this.model || !this.id) {
                    console.warn(`Warning: Either 'model' or 'id' variable is empty or null. Model: ${this.model}, ID: ${this.id}`);
                    return;
                }
                const res = await axios.post('/checkout', { model: this.model, id: this.id });
                console.log({ res })
            } catch (error) {
                console.error(error);
            }
            finally {

            }
        },
        parseBarcodeData() {
            const [model, id] = this.barcode.split('-');
            this.model = model;
            this.id = id;
        }
    }
}
</script>
