<template>
    <form
        id="fastSaleForm"
        class="grid grid-rows-3 grid-flow-col grid-cols-5 w-full"
        @submit.prevent="submit"
    >
        <div class="col-span-5" :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Descripción</label>
            <textarea
                name="description"
                ref="description"
                v-model="form.description"
                @keydown.down="nextItem"
                :class="[inputStyle]"
                placeholder="Descripción del producto o servicio"
            ></textarea>
        </div>
        <div class="col-span-5" :class="controlsContainerStyle">
            <label :class="[labelStyle]">Precio</label>
            <input
                type="text"
                ref="price"
                name="price"
                v-model="form.price"
                :class="[inputStyle]"
                placeholder="Precio"
                @keydown.enter="submit"
            />
        </div>
        <div class="col-span-5" :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Cantidad</label>
            <input
                type="text"
                name="qty"
                ref="qty"
                v-model="form.qty"
                :class="[inputStyle]"
                placeholder="Cantidad de venta"
                @keydown.enter="submit"
            />
        </div>

        <div class="flex ml-10 justify-start items-center w-full row-span-3">
            <div class="flex items-center">
                <errors-component :errors-found="errors" />
            </div>
            <!-- <button
                v-show="!errors"
                class="
                    h-32
                    w-32
                    text-2xl
                    rounded-full
                    
                    hover:bg-blue-700
                    bg-blue-500
                    text-white
                    font-mono font-bold
                "
            >
                Crear
            </button> -->
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
                this.toggleDisabled();
                const {
                    data: { data },
                } = await axios.post("/fast-sales", this.form);
                EventBus.$emit("fast-sale", data);
                this.form = {};
                this.toggleDisabled();
                this.$refs.description.focus();
                this.notify({
                    title: "Venta rapida",
                    message: "Producto agregado",
                });
            } catch (err) {
                this.getErrors(err);
            }
        },
        toggleDisabled(){
            const fields = document.getElementById('fastSaleForm').elements;
            for(let i=0; i<fields.length; i++) {
                fields[i].disabled =!fields[i].disabled ;
            }
        },
        nextItem(e){
            e.target.nextElementSi
        }
    },
    computed: {
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-mono font-semibold mr-2 rounded-sm py-3 px-6 bg-gray-200";
        },
        inputStyle() {
            return " placeholder:italic bg-stripes-gray  font-semibold placeholder-gray-600 placeholder-shown:border-gray-500 appearance-none bg-gray-200  rounded w-8/12 py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent";
        },
        controlsContainerStyle() {
            return "flex flex-wrap flex-row  justify-center items-center w-full ";
        },
    },
};
</script>
<style scoped>
.bg-stripes-pink {
    background-color: #f472b61a;
    background-image: linear-gradient(
        135deg,
        #ec489980 10%,
        transparent 0,
        transparent 50%,
        #ec489980 0,
        #ec489980 60%,
        transparent 0,
        transparent
    );
    background-size: 7.07px 7.07px;
}
.bg-stripes-gray {
    background-color: #9ca3af1a;
    background-image: linear-gradient(
        135deg,
        #6b728080 10%,
        transparent 0,
        transparent 50%,
        #6b728080 0,
        #6b728080 60%,
        transparent 0,
        transparent
    );
    background-size: 7.07px 7.07px;
}
</style>
