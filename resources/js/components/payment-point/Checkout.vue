<template>
    <nav-component>
        <div class="max-w-4xl m-auto bg-white rounded shadow p-4">
            <h1 class="font-bold text-2xl text-slate-800 p-2 text-center">Caja de cobro</h1>

            <form class="w-full" @submit.prevent="submit">
                <div class="">
                    <input name="checkout" class="w-full px-4 py-2 rounded-sm bg-slate-200" />
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

            } catch (error) {

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
