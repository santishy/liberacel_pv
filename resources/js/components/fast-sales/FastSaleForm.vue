<template>
    <form
        id="fastSaleForm"
        ref="quickSaleForm"
        class="grid grid-rows-4 grid-flow-col grid-cols-5 w-full"
        @submit.prevent="submit"
    >
        
        <div class="col-span-5" :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Descripción</label>
            <textarea
                name="description"
                ref="description"
                v-model="form.description"
                @keydown.down.exact.prevent="nextFocus"
                @keydown.ctrl.space.exact.prevent="openModal"
                @click.prevent="focusedIndex = 0"
                :class="[inputStyle]"
                placeholder="Descripción del producto o servicio"
                autocomplete="off"
            ></textarea>
        </div>
        <div class="col-span-5" :class="[controlsContainerStyle]">
            <label :class="[labelStyle]">Categoría</label>
            <search-select
                class="w-8/12"
                :collection="productBonuses"
                :input-class="'bg-stripes-gray w-full' + inputStyle"
            ></search-select>
        </div>
        <div class="col-span-5 w-full" :class="controlsContainerStyle">
            <label :class="[labelStyle]">Precio</label>
            <input
                type="text"
                ref="price"
                name="price"
                v-model="form.price"
                :class="[inputStyle]"
                placeholder="Precio"
                @click.prevent="focusedIndex = 1"
                @keydown.enter="submit"
                @keydown.down.exact.prevent="nextFocus"
                @keydown.up.exact.prevent="previousFocus"
                @keydown.ctrl.space.exact.prevent="openModal"
                autocomplete="off"
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
                @click.prevent="focusedIndex = 2"
                @keydown.up.exact.prevent="previousFocus"
                @keydown.ctrl.space.exact.prevent="openModal"
                autocomplete="off"
            />
        </div>

        <div class="flex ml-10 justify-start items-center w-full row-span-3">
            <div class="flex items-center">
                <errors-component :errors-found="errors" />
            </div>
        </div>
    </form>
</template>

<script>
import SearchSelect from "../partials/SearchSelect.vue";
export default {
    components: {
        SearchSelect,
    },
    props: {
        productBonuses: {
            type: Array,
        },
    },
    data() {
        return {
            form: {},
            focusedIndex: 0,
        };
    },
    mounted() {
        this.focusDescription();
        EventBus.$on("focus-description", this.focusDescription);
        EventBus.$on("selected-item" ,(item) => {
            this.form.product_bonus_id = item.id;
        })
    },
    methods: {
        async submit() {
            try {
                //this.toggleDisabled();
                const {
                    data: { data },
                } = await axios.post("/fast-sales", this.form);
                EventBus.$emit("fast-sale", data);
                EventBus.$emit("reset-search-select");
                this.form = {};
                this.notify({
                    title: "Venta rapida",
                    message: "Producto agregado",
                });
            } catch (err) {
                this.getErrors(err);
            }
            //this.toggleDisabled();
            this.focusedIndex = 0;
            this.$refs.description.focus();
        },
        toggleDisabled() {
            const fields = document.getElementById("fastSaleForm").elements;
            for (let i = 0; i < fields.length; i++) {
                fields[i].disabled = !fields[i].disabled;
            }
        },
        nextFocus(e) {
            this.focusedIndex += 1;
            this.itemFocus();
        },
        previousFocus() {
            this.focusedIndex -= 1;
            this.itemFocus();
        },
        itemFocus() {
            this.$refs.quickSaleForm.children[
                this.focusedIndex
            ].children[1].focus();
        },
        openModal() {
            EventBus.$emit("open-modal", true);
        },
        focusDescription() {
            this.$refs.description.focus();
        },
    },
    computed: {
        labelStyle() {
            return " w-3/12 text-center text-gray-700 font-mono font-semibold mr-2 rounded-sm py-3 px-6 bg-gray-300";
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
</style>
