<template>
    <layout-component>
        <div class="flex justify-center items-center w-full ">

            <div class="flex justify-center items-center flex-col w-9/12 px-4 bg-white py-6 rounded">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Asignar boleto</h2>
                <form @submit.prevent="submit" class="flex gap-4 justify-center items-center flex-col w-full max-w-3xl">
                    <div class="w-full">
                        <label class="block w-full text-left text-gray-700 font-semibold mb-2">Numero de
                            teléfono</label>
                        <input type="text" v-model="form.customer_phone" class="input-style w-full" style="width: 100%;"
                            placeholder="Ingrese el número de teléfono" />
                    </div>
                    <div class="w-full">
                        <label class="block w-full text-left text-gray-700 font-semibold mb-2">Nota</label>
                        <input type="number" v-model="form.saleable_id" class="input-style w-full" style="width: 100%;"
                            placeholder="Ingrese el número de teléfono" />
                    </div>
                    <div class="w-full">
                        <label class="block w-full text-left text-gray-700 font-semibold mb-2">Tipo de venta</label>
                        <select v-model="form.saleable_type" class="input-style w-full" style="width: 100%;">
                            <option selected disabled>Tipo de venta</option>
                            <option value="FastSale">Expres</option>
                            <option value="Sale">Stock</option>
                        </select>
                    </div>
                    <errors-component />
                    <div class="w-full">
                        <button
                            class=" bg-blue-500 rounded shadow-sm transition-all duration-500 ease-in-out hover:bg-blue-700 text-gray-100 font-semibold hover:text-white py-2 px-8 border-b-2 border-blue-500 hover:border-transparent">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </layout-component>
</template>
<script>
export default {
    data() {
        return {
            form: {
                customer_phone: '',
                saleable_id: '',
                saleable_type: 'Tipo de venta'
            }
        };
    },
    mounted() {

    },
    methods: {
        async submit() {
            try {
                const response = await axios.post('/raffle-assginaments/assign-by-saleable', this.form);
                EventBus.$emit('an-action-was-made', 'El boleto fue asignado correctamente.');
                // TODO Resetear formulario e imprimir boletos asignados
                this.form = {
                    customer_phone: '',
                    saleable_id: '',
                    saleable_type: 'Tipo de venta'
                };
                const url = `/raffle-numbers/${response.data.data.id}/ticket`;
                window.open(url, '_blank');
            } catch (error) {
                EventBus.$emit('an-error-ocurred', error);
                console.error("Error submitting the form:", error);
            }
        }
    }
};
</script>
