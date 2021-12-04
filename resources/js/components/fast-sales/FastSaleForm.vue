<template>
    <form
        class="grid grid-rows-3 grid-flow-col w-full"
        @submit.prevent="submit"
    >
        <div :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Descripción</label>
            <textarea
                name="description"
                v-model="form.description"
                :class="[inputStyle]"
                placeholder="Descripción del producto o servicio"
            ></textarea>
        </div>
        <div :class="controlsContainerStyle">
            <label :class="[labelStyle]">Precio</label>
            <input
                type="text"
                name="price"
                v-model="form.price"
                :class="[inputStyle]"
                placeholder="Precio"
            />
        </div>
        <div :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Cantidad</label>
            <input
                type="text"
                name="qty"
                v-model="form.qty"
                :class="[inputStyle]"
                placeholder="Cantidad de venta"
            />
        </div>

        <div class="flex ml-10 justify-start items-center w-full row-span-3">
            <div class="flex items-center">
                <errors-component :errors-found="errors" />
            </div>
            <button
                class="
                    h-32
                    w-32
                    text-2xl
                    rounded-full
                    ml-4
                    hover:bg-blue-700
                    bg-blue-500
                    text-white
                    font-mono font-bold
                "
            >
                Crear
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {},
        };
    },
    methods: {
        async submit() {
            try {
                const res = await axios.post("/fast-sales", this.form);
                EventBus.$emit("fast-sale",res.data);
            } catch (err) {
                this.getErrors(err);
            }
        },
    },
    computed: {
        labelStyle() {
            return " w-3/12 text-center font-mono font-semibold mr-2 rounded-sm py-3 px-6 bg-gray-200";
        },
        inputStyle() {
            return " placeholder-green-300 appearance-none bg-gray-200  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
    },
};
</script>
