<template>
    <nav-component>

        <div class="flex">
            <div class="flex items-center me-4">
                <input id="inline-radio" type="radio" value="" name="inline-radio-group"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline
                    1</label>
            </div>
            <div class="flex items-center me-4">
                <input id="inline-2-radio" type="radio" value="" name="inline-radio-group"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline
                    2</label>
            </div>
            <div class="flex items-center me-4">
                <input checked id="inline-checked-radio" type="radio" value="" name="inline-radio-group"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-checked-radio"
                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inline checked</label>
            </div>
            <div class="flex items-center">
                <input disabled id="inline-disabled-radio" type="radio" value="" name="inline-radio-group"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="inline-disabled-radio"
                    class="ms-2 text-sm font-medium text-gray-400 dark:text-gray-500">Inline disabled</label>
            </div>
        </div>

        <div class="max-w-4xl m-auto bg-white rounded shadow p-4">
            <h1 class="font-bold text-2xl text-slate-800 p-2 text-center">Caja de cobro</h1>

            <form class="w-full" @submit.prevent="submit">
                <div class="">
                    <input name="checkout" v-model="barcode" class="w-full px-4 py-2 rounded-sm bg-slate-200" />
                </div>
            </form>
        </div>
    </nav-component>
</template>
<script>
import NavComponent from "../NavComponent.vue";
export default {
    components: {
        NavComponent,
    },
    data() {
        return {
            barcode: '',
            model: null,
            id: null,
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
